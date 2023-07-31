<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BgRemovedPrediction extends Model
{
    use HasFactory;

    protected $fillable = ['prediction_result_id', 'user_id', 'output_url', 'generated_file_name', 'status'];

    public function result()
    {
        return $this->belongsTo(PredictionResult::class);
    }
}
