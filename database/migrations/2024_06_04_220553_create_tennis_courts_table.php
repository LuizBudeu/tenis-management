<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enums\TennisCourtStatus;
use App\Enums\TennisCourtType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tennis_courts', function (Blueprint $table) {
            $table->id();
            $table->integer('court_number');
            $table->enum('court_type', TennisCourtType::toArray())->default(TennisCourtType::getDefaultValue());
            $table->enum('status', TennisCourtStatus::toArray())->default(TennisCourtStatus::getDefaultValue());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tennis_courts');
    }
};
