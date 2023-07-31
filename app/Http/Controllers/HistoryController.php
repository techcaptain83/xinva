<?php

namespace App\Http\Controllers;

use App\Models\BgRemovedPrediction;
use App\Models\Prediction;
use App\Models\PredictionResult;
use App\Models\User;
use App\Models\VariantMakerPrediction;
use Inertia\Inertia;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function get()
    {
        $historyData = [];
        $predictions = PredictionResult::whereHas('prediction', function($query) {
            $query->where('user_id', auth()->user()->id);
        })->selectRaw('id,generated_file_name, DATE(created_at) as date')->whereNotNull('generated_file_name')->latest()->get();
        foreach($predictions as $prediction) {
            $historyData[$prediction->date][] = ['route' => route('download', ['id' => $prediction->id]), 'src' => asset('storage/generated_images/'.$prediction->generated_file_name)];
        }
        $bgRemoved = BgRemovedPrediction::selectRaw('id,generated_file_name, DATE(created_at) as date')->where('user_id', auth()->user()->id)->whereNotNull('generated_file_name')->latest()->get();
        foreach($bgRemoved as $prediction) {
            $historyData[$prediction->date][] = ['route' => route('downloadBGRemoved', ['id' => $prediction->id]), 'src' => asset('storage/generated_images/bg_removed/'. $prediction->generated_file_name)];
        }
        $variantMaker = VariantMakerPrediction::selectRaw('id,generated_file_name, DATE(created_at) as date')->where('user_id', auth()->user()->id)->whereNotNull('generated_file_name')->latest()->get();
        foreach($variantMaker as $prediction) {
            $historyData[$prediction->date][] = ['route' => route('variantMakerPredictionDownload', ['id' => $prediction->id]), 'src' => asset('storage/generated_images/variant_maker/'. $prediction->generated_file_name)];
        }
        // dd($historyData);
        // dd($predictions, $historyData);

        return Inertia::render(
            'History',
            [
                'predictions' => $historyData,
            ]
        );
    }
}
