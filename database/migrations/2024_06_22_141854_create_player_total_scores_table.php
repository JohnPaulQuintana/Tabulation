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
        Schema::create('player_total_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('total_score')->default(0);
            $table->boolean('game_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_total_scores');
    }
};
