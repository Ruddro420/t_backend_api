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
        Schema::create('room_models', function (Blueprint $table) {
            $table->id();
            $table->string('match_id');
            $table->string('room_id')->nullable();
            $table->string('room_password')->nullable();
            // You can add more fields as needed
            // For example, if you want to store the room's status or creation time
            $table->string('ex1')->nullable();
            $table->string('ex2')->nullable();
            $table->timestamps();
            $table->foreign('match_id')
                ->references('match_id')
                ->on('matches_models')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_models');
    }
};
