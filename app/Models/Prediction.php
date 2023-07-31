<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'prompt',
        'prediction_id',
        'status'
    ];

    // protected $with = ['results'];

    public function results()
    {
        return $this->hasMany(PredictionResult::class);
    }

    public function bgRemovedResults()
    {
        return $this->hasManyThrough(BgRemovedPrediction::class, PredictionResult::class);
    }
   
    public function scaledResults()
    {
        return $this->hasManyThrough(ScalePrediction::class, PredictionResult::class);
    }
    
}
