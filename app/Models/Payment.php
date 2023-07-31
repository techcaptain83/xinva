<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Plan;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'plan_id', 'paddle_checkout_id', 'paddle_subscription_id', 'amount_subtotal', 'amount_total', 'currency', 'payment_status'];


    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
