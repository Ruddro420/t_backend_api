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
            $table->string('user_id'); // assuming users table uses big increments
            $table->string('payment_method'); // e.g., 'bkash', 'rocket', etc.
            $table->string('payment_phone_number');
            $table->string('transaction_id')->unique();
            $table->decimal('amount', 10, 2);
            $table->string('status')->default('pending'); // e.g., pending, success, failed
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
