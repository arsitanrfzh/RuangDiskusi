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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            // Membuat FK 'user_id' (BigInt)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // Membuat FK 'category_id' (BigInt)
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');

            $table->string('title');
            $table->text('body');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};