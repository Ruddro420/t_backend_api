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
            $table->string('match_id')->nullable();
            $table->string('match_name')->nullable();
            $table->unsignedBigInteger('category_id')->nullable(); // Foreign key
            $table->string('max_player')->nullable();
            $table->string('map_name')->nullable();
            $table->string('version')->nullable();
            $table->string('game_type')->nullable();
            $table->string('game_mood')->nullable();
            $table->string('time')->nullable();
            $table->string('date')->nullable();
            $table->string('win_price')->nullable();
            $table->string('kill_price')->nullable();
            $table->string('entry_fee')->nullable();
            $table->string('second_prize')->nullable();
            $table->string('third_prize')->nullable();
            $table->string('fourth_prize')->nullable();
            $table->string('fifth_prize')->nullable();
            $table->string('total_prize')->nullable();
            $table->string('status')->default(0);
            $table->string('ex1')->nullable();
            $table->string('ex2')->nullable();
            $table->timestamps();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('set null'); // or use 'cascade' depending on logic
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
