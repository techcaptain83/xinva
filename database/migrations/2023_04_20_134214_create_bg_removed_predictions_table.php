<?php

use App\Models\PredictionResult;
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
        Schema::create('bg_removed_predictions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PredictionResult::class);
            $table->string('bg_prediction_id')->nullable();
            $table->string('output_url')->nullable();
            $table->string('generated_file_name')->nullable();
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bg_removed_predictions');
    }
};
