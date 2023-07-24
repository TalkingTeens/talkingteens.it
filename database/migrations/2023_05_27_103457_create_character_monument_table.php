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
        Schema::create('character_monument', function (Blueprint $table) {
            $table->foreignId('character_id')->constrained();
            $table->foreignId('monument_id')->constrained();
            $table->json('description')->nullable();

            $table->primary(['character_id', 'monument_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('character_monument');
    }
};
