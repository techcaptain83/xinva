<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('stripe_id');
            $table->dropColumn('stripe_price_id');
            $table->string('paddle_checkout_id')->after('plan_id')->nullable();
            $table->string('paddle_subscription_id')->after('paddle_checkout_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('paddle_subscription_id');
        });
    }
};
