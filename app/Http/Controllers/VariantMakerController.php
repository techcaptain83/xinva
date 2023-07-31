<?php

namespace App\Http\Controllers;

use App\Models\Prediction;
use App\Models\PredictionResult;
use App\Models\VariantMakerPrediction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class VariantMakerController extends Controller
{
    public function prediction(Request $request)
    {
        $prediction_result = PredictionResult::find($request->id);
        if (!$prediction_result) {
            return redirect()->to('/dashboard');
        }

        $bg_removed_prediction = VariantMakerPrediction::create([
            'prediction_result_id' => $prediction_result->id, 'user_id' => auth()->user()->id
        ]);

        $response = Http::withHeaders([
            "Authorization" => 'Token ' . env("REPLICATE_API_TOKEN"),
            "Content-Type" => "application/json",
        ])->post('https://api.replicate.com/v1/predictions', [
                'version' => env('REPLICATE_VARIANT_MAKER_MODEL'),
                'input' => ["input_image" => $prediction_result->output_url, 'num_outputs' => 2],
            ]);

        $data = $response->json();

        if ($response->status() == 201) {
            $bg_removed_prediction->status = 'success';
            $bg_removed_prediction->vm_prediction_id = $data['id'];
            $bg_removed_prediction->save();
            return Inertia::render('VariantMaker', ['success' => true, 'vm_prediction_id' => $bg_removed_prediction->id]);
        }

        $bg_removed_prediction->status = 'failed';
        $bg_removed_prediction->vm_prediction_id = $data['id'];
        $bg_removed_prediction->save();

        return Inertia::render('VariantMaker', ['success' => false, 'vm_prediction_id' => $bg_removed_prediction->id, 'error' => $response->throw()->json()]);

        // -------------------

        // $prediction = Prediction::create([
        //     'user_id' => auth()->user()->id,
        //     'prompt' => 'variant maker prediction on user file',
        // ]);

        // $response = Http::withHeaders([
        //     "Authorization" => 'Token ' . env("REPLICATE_API_TOKEN"),
        //     "Content-Type" => "application/json",
        // ])->post('https://api.replicate.com/v1/predictions', [
        //     'version' => env('REPLICATE_VARIANT_MAKER_MODEL'),
        //     'input' => ["input" => $request->path],
        // ]);

        // $data = $response->json();
        // if ($response->status() == 201) {
        //     $prediction->status = 'success';
        //     $prediction->prediction_id = $data['id'];
        //     $prediction->save();

        //     $user = auth()->user();
        //     $user->credits_used += 1;
        //     $user->save();
        //     return response()->json(['success' => true, 'prediction_id' => $prediction->id]);
        // }

        // $prediction->status = 'failed';
        // $prediction->prediction_id = $data['id'];
        // $prediction->save();
        // return response()->json(['success' => false, 'prediction_id' => $prediction->id, 'error' => $response->throw()->json()]);
    }

    public function predictionResults(Request $request) {

        $vm_prediction_result = VariantMakerPrediction::find($request->id);
        if (!$vm_prediction_result) {
            return response()->json(['success' => false, 'error' => 'Unable to find the requested prediction id']);
        }

        $response = Http::withHeaders([
            "Authorization" => 'Token ' . env("REPLICATE_API_TOKEN"),
            "Content-Type" => "application/json",
        ])->get('https://api.replicate.com/v1/predictions/' . $vm_prediction_result->vm_prediction_id);

        $data = $response->json();

        if ($data['completed_at'] != null && $data['output']) {

            $generated_images = [];

            foreach ($data['output'] as $key => $output_url) {

                if($key != 0) {
                    $vm_prediction_result = VariantMakerPrediction::create(['prediction_result_id' => $vm_prediction_result->prediction_result_id, 'vm_prediction_id' => $vm_prediction_result->vm_prediction_id, 'user_id' => auth()->user()->id]);
                }

                $vm_prediction_result->output_url = $output_url;

                $name = 'variant_maker_predictions_result_' . $vm_prediction_result->id . '.png';
                $vm_prediction_result->generated_file_name = $name;
                $vm_prediction_result->save();
                Storage::put('public/generated_images/variant_maker/' . $name, file_get_contents($output_url));
                $vm_prediction_result->status = 'success';
                $vm_prediction_result->save();
                $generated_images[$vm_prediction_result->id] = asset('storage/generated_images/variant_maker/'.$name);
            }

            return response()->json([
                'success' => true,
                'output' => $generated_images,
                'vm_prediction_id' => $vm_prediction_result->id,
            ]);
        }
        return response()->json(['success' => true, 'output' => null]);

    }

}
