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
        Schema::create('stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_id')->constrained('matches')->cascadeOnDelete();
            $table->foreignId('player_id')->constrained('players')->cascadeOnDelete();
            $table->integer('start_minute')->nullable();
            $table->integer('end_minute')->nullable();
            $table->integer('goals')->nullable();
            $table->integer('assists')->nullable();
            $table->integer('interceptions')->nullable();
            $table->integer('clearances')->nullable();
            $table->integer('tackles')->nullable();
            $table->integer('saves')->nullable();
            $table->integer('fouls')->nullable();
            $table->integer('yellow_cards')->nullable();
            $table->integer('red_cards')->nullable();
            $table->decimal('succ_passes', 5, 2)->nullable();
            $table->decimal('succ_ground_duels', 5, 2)->nullable();
            $table->decimal('succ_aerial_duels', 5, 2)->nullable();
            $table->decimal('succ_dribbles', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stats');
    }
};
