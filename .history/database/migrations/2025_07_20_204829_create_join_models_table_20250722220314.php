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
        Schema::create('join_models', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->unsignedBigInteger('match_id')->nullable();
            $table->string('game_type')->nullable();
            $table->string('entry_fee')->nullable();
            $table->string('game_date')->nullable();
            $table->string('game_time')->nullable();
            $table->string('win_prize')->nullable();
            $table->string('status')->default(0);
            $table->string('pname1')->nullable();
            $table->string('pname2')->nullable();
            $table->string('game_name')->nullable();
            $table->string('pay')->nullable();
            $table->string('ex1')->nullable();
            $table->string('ex2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('join_models');
    }
};
