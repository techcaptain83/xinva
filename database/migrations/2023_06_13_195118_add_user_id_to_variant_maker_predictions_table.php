<?php

use App\Models\User;
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
        Schema::table('variant_maker_predictions', function (Blueprint $table) {
            $table->foreignIdFor(User::class)->after('prediction_result_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('variant_maker_predictions', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
};
