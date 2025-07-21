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
        Schema::create('deposites', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_phone_number')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('status')->default(0);
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
        Schema::dropIfExists('deposites');
    }
};
