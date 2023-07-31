<?php

namespace App\Http\Controllers;

use App\Models\Prediction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PromptGeneratorController extends Controller
{
    public function getPrompt(Request $request) {

        $prediction = Prediction::create([
            'user_id' => auth()->user()->id,
            'prompt' => $request->prompt,
        ]);

        $response = Http::withHeaders([
            "Authorization" => 'Token ' . env("REPLICATE_API_TOKEN"),
            "Content-Type" => "application/json",
        ])->post('https://api.replicate.com/v1/predictions', [
            'version' => env('REPLICATE_PROMPT_GENERATOR_MODEL'),
            'input' => ["prompt" => $request->prompt],
        ]);

        $data = $response->json();

        if ($response->status() == 201) {
            $prediction->status = 'success';
            $prediction->prediction_id = $data['id'];
            $prediction->save();

            // $user = auth()->user();
            // $user->credits_used += 1;
            // $user->save();
            return response()->json(['success' => true, 'prediction_id' => $prediction->id]);
        }
        $prediction->status = 'failed';
        $prediction->prediction_id = $data['id'];
        $prediction->save();
        return response()->json(['success' => false, 'prediction_id' => $prediction->id, 'error' => $response->throw()->json()]);
    }

    public function prediction(Request $request)
    {
        $prediction = Prediction::find($request->id);
        if (!$prediction) {
            return response()->json(['success' => false, 'error' => 'Unable to find the requested prediction id']);
        }

        $response = Http::withHeaders([
            "Authorization" => 'Token ' . env("REPLICATE_API_TOKEN"),
            "Content-Type" => "application/json",
        ])->get('https://api.replicate.com/v1/predictions/' . $prediction->prediction_id);

        $data = $response->json();
        if(isset($data['completed_at']) && $data['completed_at'] != null && $data['output']){

            $generated_text = view('prompt-text-view', ['text' => $data['output']])->render(); //str_replace("\n", "<br>", );
            // $generated_text = '<p>'.$generated_text.'</p>';
            // $generated_images = [];

            // foreach ($data['output'] as $key => $output_url){
            //     $prediction_result = PredictionResult::create([
            //         'prediction_id' => $prediction->id,
            //         'output_url' => $output_url,
            //     ]);

            //     $name = 'predictions_'.$prediction->id.'_result_'.$prediction_result->id.'.png';
            //     $prediction_result->generated_file_name = $name;
            //     $prediction_result->save();
            //     Storage::put('public/generated_images/'.$name, file_get_contents($output_url));
            //     $prediction_result->status = 'success';
            //     $prediction_result->save();

            //     $generated_images[$prediction_result->id] = asset('storage/generated_images/'.$name);
            // }


            return response()->json(['success' => true, 'output' => $generated_text ]);
        }
        return response()->json(['success' => true, 'output' => null ]);
    }
}
