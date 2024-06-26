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
        Schema::create('player_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('team_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('event_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('judge_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('player_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_scores');
    }
};
