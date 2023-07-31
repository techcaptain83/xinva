<?php

namespace App\Http\Controllers;

use App\Models\Prediction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TextToAnimeController extends Controller
{
    public function prediction(Request $request)
    {

        $prediction = Prediction::create([
            'user_id' => auth()->user()->id,
            'prompt' => $request->prompt,
        ]);

        $response = Http::withHeaders([
            "Authorization" => 'Token ' . env("REPLICATE_API_TOKEN"),
            "Content-Type" => "application/json",
        ])->post('https://api.replicate.com/v1/predictions', [
            'version' => env('REPLICATE_TEXT_TO_ANIME_MODEL'),
            'input' => ["prompt" => $request->prompt, 'num_outputs' => 1, 'width' => 512, 'height' => 512],
        ]);

        $data = $response->json();
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
}
