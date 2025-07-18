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
        Schema::create('match_models', function (Blueprint $table) {
            $table->id();
            $table->string('match_name');
            $table->string('category');
            $table->integer('max_player');
            $table->string('map_name');
            $table->string('version');
            $table->string('game_type')->nullable();
            $table->string('game_mood')->nullable();
            $table->time('time');
            $table->date('date');
            $table->decimal('win_price', 8, 2);
            $table->decimal('kill_price', 8, 2);
            $table->decimal('entry_fee', 8, 2);
            $table->decimal('second_prize', 8, 2)->nullable();
            $table->decimal('third_prize', 8, 2)->nullable();
            $table->decimal('fourth_prize', 8, 2)->nullable();
            $table->decimal('fifth_prize', 8, 2)->nullable();
            $table->decimal('total_prize', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_models');
    }
};
