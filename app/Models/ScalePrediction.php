<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScalePrediction extends Model
{
    use HasFactory;

    protected $fillable = ['scale_prediction_id','prediction_result_id', 'output_url', 'generated_file_name', 'status'];
    // protected $guaded = [];
}
