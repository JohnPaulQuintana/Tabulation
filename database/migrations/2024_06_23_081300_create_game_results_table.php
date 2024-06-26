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
        Schema::create('game_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sport_category_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('team_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('status')->default('completed');
            $table->string('result')->default('lose');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_results');
    }
};
