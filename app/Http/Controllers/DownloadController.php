<?php

namespace App\Http\Controllers;

use App\Models\PredictionResult;
use App\Models\BgRemovedPrediction;
use App\Models\ScalePrediction;
use Illuminate\Http\Request;
use App\Models\Download;
use App\Models\VariantMakerPrediction;
use Illuminate\Support\Facades\Http;

class DownloadController extends Controller
{
    public function download(Request $request)
    {

        $prediction_result = PredictionResult::find($request->id);
        if (!$prediction_result) {
            return response()->json(['sccuess' => false, 'error' => 'The requested file not not found.']);
        }

        return response()->download(storage_path('app/public/generated_images/'.$prediction_result->generated_file_name));


    }

    public function downloadBGRemoved(Request $request)
    {

        $bg_prediction_result = BgRemovedPrediction::find($request->id);
        if (!$bg_prediction_result) {
            return response()->json(['sccuess' => false, 'error' => 'The requested file not not found.']);
        }

        return response()->download(storage_path('app/public/generated_images/bg_removed/'.$bg_prediction_result->generated_file_name));


    }

    public function downloadscale(Request $request)
    {

        $scale_prediction_result = ScalePrediction::find($request->id);
        if (!$scale_prediction_result) {
            return response()->json(['sccuess' => false, 'error' => 'The requested file not not found.']);
        }

        return response()->download(storage_path('app/public/generated_images/scale_image/'.$scale_prediction_result->generated_file_name));


    }

    public function variantMakerPredictionDownload(Request $request)
    {

        $scale_prediction_result = VariantMakerPrediction::find($request->id);
        if (!$scale_prediction_result) {
            return response()->json(['sccuess' => false, 'error' => 'The requested file not not found.']);
        }

        return response()->download(storage_path('app/public/generated_images/variant_maker/'.$scale_prediction_result->generated_file_name));


    }

}
