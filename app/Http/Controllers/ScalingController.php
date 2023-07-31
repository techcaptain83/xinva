<?php

namespace App\Http\Controllers;

use App\Models\ScalePrediction;
use App\Models\BgRemovedPrediction;
use App\Models\PredictionResult;
use App\Models\VariantMakerPrediction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;


class ScalingController extends Controller
{
    public function scaling(Request $request)
    {
        $prediction_result = PredictionResult::find($request->id);
        if (!$prediction_result) {
            return redirect()->to('/dashboard');
        }

        $scale_prediction = ScalePrediction::create([
            'prediction_result_id' => $prediction_result->id,
        ]);

        if(!$scale_prediction) {
            return redirect()->route('pricing-credit');
        }

        $response = Http::withHeaders([
            "Authorization" => 'Token ' . env("REPLICATE_API_TOKEN"),
            "Content-Type" => "application/json",
        ])->post('https://api.replicate.com/v1/predictions', [
            'version' => env('REPLICATE_SCALED_GENERATOR_MODEL'),
            'input' => [ "img" => $prediction_result->output_url, 'scale' => 4 , 'version' => 'Anime - anime6B' ],
        ]);

        $data = $response->json();
        // dd($data);

        if ($response->status() == 201) {
            $scale_prediction->status = 'success';
            $scale_prediction->scale_prediction_id = $data['id'];
            $scale_prediction->save();

            return Inertia::render('Scale', ['success' => true, 'scale_prediction_id' => $scale_prediction->id]);
        }

        $scale_prediction->status = 'failed';
        $scale_prediction->scale_prediction_id = $data['id'];
        $scale_prediction->save();

        return Inertia::render('Scale', ['success' => false, 'scale_prediction_id' => $scale_prediction->id, 'error' => $response->throw()->json()]);

    }


    public function scaling_image(Request $request)
    {

        $scale_prediction_result = ScalePrediction::find($request->id);
        if (!$scale_prediction_result) {
            return response()->json(['success' => false, 'error' => 'Unable to find the requested prediction id']);
        }

        $response = Http::withHeaders([
            "Authorization" => 'Token ' . env("REPLICATE_API_TOKEN"),
            "Content-Type" => "application/json",
        ])->get('https://api.replicate.com/v1/predictions/' . $scale_prediction_result->scale_prediction_id);

        $data = $response->json();

        if ($data['completed_at'] != null && $data['output']) {


            $scale_prediction_result->output_url = $data['output'];

            $name = 'scale_predictions_result_' . $scale_prediction_result->id . '.png';
            $scale_prediction_result->generated_file_name = $name;
            $scale_prediction_result->save();
            Storage::put('public/generated_images/scale_image/' . $name, file_get_contents($data['output']));
            $scale_prediction_result->status = 'success';
            $scale_prediction_result->save();

            return response()->json([
                'success' => true,
                'output' => asset('storage/generated_images/scale_image/' . $name),
                'scale_prediction_id' => $scale_prediction_result->id,
            ]);
        }
        return response()->json(['success' => true, 'output' => null]);
    }

    public function scaleBGRemoved(Request $request)
    {
        $bg_prediction = BgRemovedPrediction::find($request->id);
        if (!$bg_prediction) {
            return redirect()->to('/dashboard');
        }

        $scale_prediction = ScalePrediction::create([
            'prediction_result_id' => $bg_prediction->id,
        ]);

        if(!$scale_prediction) {
            return redirect()->route('pricing-credit');
        }

        $response = Http::withHeaders([
            "Authorization" => 'Token ' . env("REPLICATE_API_TOKEN"),
            "Content-Type" => "application/json",
        ])->post('https://api.replicate.com/v1/predictions', [
            'version' => 'c263265e04b16fda1046d1828997fc27b46610647a3348df1c72fbffbdbac912',
            'input' => [ "image" => $bg_prediction->output_url ],
        ]);

        $data = $response->json();

        if ($response->status() == 201) {
            $scale_prediction->status = 'success';
            $scale_prediction->scale_prediction_id = $data['id'];
            $scale_prediction->save();

            return Inertia::render('Scale', ['success' => true, 'scale_prediction_id' => $scale_prediction->id]);
        }

        $scale_prediction->status = 'failed';
        $scale_prediction->scale_prediction_id = $data['id'];
        $scale_prediction->save();

        return Inertia::render('Scale', ['success' => false, 'scale_prediction_id' => $scale_prediction->id, 'error' => $response->throw()->json()]);

    }

    public function scaleVariantMaker(Request $request)
    {
        $vm_prediction = VariantMakerPrediction::find($request->id);
        if (!$vm_prediction) {
            return redirect()->to('/dashboard');
        }

        $scale_prediction = ScalePrediction::create([
            'prediction_result_id' => $vm_prediction->id,
        ]);

        if(!$scale_prediction) {
            return redirect()->route('pricing-credit');
        }

        $response = Http::withHeaders([
            "Authorization" => 'Token ' . env("REPLICATE_API_TOKEN"),
            "Content-Type" => "application/json",
        ])->post('https://api.replicate.com/v1/predictions', [
            'version' => 'c263265e04b16fda1046d1828997fc27b46610647a3348df1c72fbffbdbac912',
            'input' => [ "image" => $vm_prediction->output_url ],
        ]);

        $data = $response->json();

        if ($response->status() == 201) {
            $scale_prediction->status = 'success';
            $scale_prediction->scale_prediction_id = $data['id'];
            $scale_prediction->save();

            return Inertia::render('Scale', ['success' => true, 'scale_prediction_id' => $scale_prediction->id]);
        }

        $scale_prediction->status = 'failed';
        $scale_prediction->scale_prediction_id = $data['id'];
        $scale_prediction->save();

        return Inertia::render('Scale', ['success' => false, 'scale_prediction_id' => $scale_prediction->id, 'error' => $response->throw()->json()]);

    }


}
