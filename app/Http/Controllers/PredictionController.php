<?php

namespace App\Http\Controllers;
use App\Models\Prediction;
use App\Models\Download;
use App\Models\PredictionResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;


class PredictionController extends Controller
{
    public function prediction(Request $request)
    {
        // if (!$request->user()->subscribed('default') || ($request->user()->total_credits - $request->user()->credits_used = 0)) {
        //     return response()->json(['success' => false, 'error' => 'Not enough credits for generating images. Please purchase any plans or subscribe.']);
        // }
        $animeModel = isset($request->anime_model) ? $request->anime_model : false;

        if ($animeModel) {
            $modelVersion = env('REPLICATE_TEXT_TO_ANIME_MODEL');
        } else{
            $modelVersion = env('REPLICATE_IMAGE_GENERATOR_MODEL');
        }

        $prediction = Prediction::create([
            'user_id' => auth()->user()->id,
            'prompt' => $request->prompt,
        ]);

        $response = Http::withHeaders([
            "Authorization" => 'Token ' . env("REPLICATE_API_TOKEN"),
            "Content-Type" => "application/json",
        ])->post('https://api.replicate.com/v1/predictions', [
            'version' => $modelVersion,
            'input' => ["prompt" => $request->prompt, 'batch_size' => 2, 'width' => 512, 'height' => 512],
        ]);

        $data = $response->json();
        // dd($data);
        if ($response->status() == 201) {
            $prediction->status = 'success';
            $prediction->prediction_id = $data['id'];
            $prediction->save();

            deductCredit();
            return response()->json(['success' => true, 'prediction_id' => $prediction->id]);
        }

        $prediction->status = 'failed';
        $prediction->prediction_id = $data['id'];
        $prediction->save();
        return response()->json(['success' => false, 'prediction_id' => $prediction->id, 'error' => $response->throw()->json()]);
    }



    public function result(Request $request)
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

            $generated_images = [];

            foreach ($data['output'] as $key => $output_url){
                $prediction_result = PredictionResult::create([
                    'prediction_id' => $prediction->id,
                    'output_url' => $output_url,
                ]);

                $name = 'predictions_'.$prediction->id.'_result_'.$prediction_result->id.'.png';
                $prediction_result->generated_file_name = $name;
                $prediction_result->save();
                Storage::put('public/generated_images/'.$name, file_get_contents($output_url));
                $prediction_result->status = 'success';
                $prediction_result->save();

                $generated_images[$prediction_result->id] = asset('storage/generated_images/'.$name);
            }


            return response()->json(['success' => true, 'output' => $generated_images ]);
        }
        return response()->json(['success' => true, 'output' => null ]);
    }


}

