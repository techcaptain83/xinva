<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basic extends Model
{
    use HasFactory;


    protected $fillable = ['cardno', 'date', 'year', 'cvv'];
    
}
