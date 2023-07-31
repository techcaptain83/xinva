<?php

namespace App\Http\Controllers;

use App\Models\BgRemovedPrediction;
use App\Models\Prediction;
use App\Models\PredictionResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class BackgroundController extends Controller
{
    public function removeBackground(Request $request)
    {
        $prediction_result = PredictionResult::find($request->id);
        if (!$prediction_result) {
            return redirect()->to('/dashboard');
        }

        $bg_removed_prediction = BgRemovedPrediction::create([
            'prediction_result_id' => $prediction_result->id, 'user_id' => auth()->user()->id
        ]);

        $response = Http::withHeaders([
            "Authorization" => 'Token ' . env("REPLICATE_API_TOKEN"),
            "Content-Type" => "application/json",
        ])->post('https://api.replicate.com/v1/predictions', [
                'version' => env('REPLICATE_BGREMOVED_GENERATOR_MODEL'),
                'input' => ["image" => $prediction_result->output_url],
            ]);

        $data = $response->json();

        if ($response->status() == 201) {
            $bg_removed_prediction->status = 'success';
            $bg_removed_prediction->bg_prediction_id = $data['id'];
            $bg_removed_prediction->save();
            return Inertia::render('RemoveBG', ['success' => true, 'bg_prediction_id' => $bg_removed_prediction->id]);
        }

        $bg_removed_prediction->status = 'failed';
        $bg_removed_prediction->bg_prediction_id = $data['id'];
        $bg_removed_prediction->save();

        return Inertia::render('RemoveBG', ['success' => false, 'bg_prediction_id' => $bg_removed_prediction->id, 'error' => $response->throw()->json()]);

    }


    public function remove_bg(Request $request)
    {

        $bg_prediction_result = BgRemovedPrediction::find($request->id);
        if (!$bg_prediction_result) {
            return response()->json(['success' => false, 'error' => 'Unable to find the requested prediction id']);
        }

        $response = Http::withHeaders([
            "Authorization" => 'Token ' . env("REPLICATE_API_TOKEN"),
            "Content-Type" => "application/json",
        ])->get('https://api.replicate.com/v1/predictions/' . $bg_prediction_result->bg_prediction_id);

        $data = $response->json();

        if ($data['completed_at'] != null && $data['output']) {


            $bg_prediction_result->output_url = $data['output'];

            $name = 'bg_removed_predictions_result_' . $bg_prediction_result->id . '.png';
            $bg_prediction_result->generated_file_name = $name;
            $bg_prediction_result->save();
            Storage::put('public/generated_images/bg_removed/' . $name, file_get_contents($data['output']));
            $bg_prediction_result->status = 'success';
            $bg_prediction_result->save();

            return response()->json([
                'success' => true,
                'output' => asset('storage/generated_images/bg_removed/' . $name),
                'bg_prediction_id' => $bg_prediction_result->id,
            ]);
        }
        return response()->json(['success' => true, 'output' => null]);
    }

}
