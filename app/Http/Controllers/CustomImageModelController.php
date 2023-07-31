<?php

namespace App\Http\Controllers;

use App\Models\ScalePrediction;
use App\Models\VariantMakerPrediction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CustomImageModelController extends Controller
{

    public function upscaler(Request $request)
    {
        $selectedValue = 'upscaler';
        $props = [
            'selectedValue' => $selectedValue
        ];
        return Inertia::render('Upscaler', compact('props'));
    }

    public function storeUpscaler(Request $request) {

        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg|max:4096',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'output' => $validator->errors()->first()]);
        }

        $userId = auth()->user()->id;
        $image = $request->image;
        $extension = $image->getClientOriginalExtension();
        $fileName = substr(md5(uniqid(mt_rand(0, 9999), true)), 0, 10) . '.' . $extension;

        $path = $image->storeAs('images/' . $userId , $fileName, 'public');
        $output_url = asset('storage/'.$path);

        // $output_url = 'https://app.xinva.ai/storage/generated_images/predictions_1_result_1.png';

        $response = Http::withHeaders([
            "Authorization" => 'Token ' . env("REPLICATE_API_TOKEN"),
            "Content-Type" => "application/json",
        ])->post('https://api.replicate.com/v1/predictions', [
            'version' => env('REPLICATE_SCALED_GENERATOR_MODEL'),
            'input' => [ "img" => $output_url, 'scale' => 4 , 'version' => 'Anime - anime6B' ],
        ]);

        $data = $response->json();

        $scale_prediction = ScalePrediction::create([
            'prediction_result_id' => '112233',
        ]);

        if ($response->status() == 201) {
            $scale_prediction->status = 'success';
            $scale_prediction->scale_prediction_id = $data['id'];

            deductCredit();


            $scale_prediction->save();
            return response()->json([
                'success' => true,
                'scale_prediction_id' => $scale_prediction->id,
            ]);
        }

        return response()->json([
            'success' => false,
            'scale_prediction_id' => '',
        ]);
    }

    public function variantMaker(Request $request)
    {
        $selectedValue = 'variant-maker';
        $props = [
            'selectedValue' => $selectedValue
        ];
        return Inertia::render('CustomVariantMaker', compact('props'));
    }

    public function storeVariantMaker(Request $request) {

        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg|max:4096',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'output' => $validator->errors()->first()]);
        }

        $userId = auth()->user()->id;
        $image = $request->image;
        $extension = $image->getClientOriginalExtension();
        $fileName = substr(md5(uniqid(mt_rand(0, 9999), true)), 0, 10) . '.' . $extension;

        $path = $image->storeAs('images/' . $userId , $fileName, 'public');
        $output_url = asset('storage/'.$path);

        // $output_url = 'https://app.xinva.ai/storage/generated_images/predictions_1_result_1.png';

        $response = Http::withHeaders([
            "Authorization" => 'Token ' . env("REPLICATE_API_TOKEN"),
            "Content-Type" => "application/json",
        ])->post('https://api.replicate.com/v1/predictions', [
            'version' => env('REPLICATE_VARIANT_MAKER_MODEL'),
            'input' => ["input_image" => $output_url, 'num_outputs' => 2],
        ]);

        $data = $response->json();

        $vm_prediction = VariantMakerPrediction::create([
            'prediction_result_id' => '112233', 'user_id' => auth()->user()->id
        ]);

        if ($response->status() == 201) {
            $vm_prediction->status = 'success';
            $vm_prediction->vm_prediction_id = $data['id'];

            $user = auth()->user();
            if(!$user->subscribed('default')) {
                $user->credits_used += 1;
                $user->save();
            }

            $vm_prediction->save();
            return response()->json([
                'success' => true,
                'vm_prediction_id' => $vm_prediction->id,
            ]);
        }

        return response()->json([
            'success' => false,
            'vm_prediction_id' => '',
        ]);
    }
}
