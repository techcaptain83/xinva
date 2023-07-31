<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PredictionResult extends Model
{
    use HasFactory; 

    protected $fillable = ['prediction_id', 'output_url', 'generated_file_name', 'status'];
    

    public function prediction()
    {
        return $this->belongsTo(Prediction::class);
    }

}
