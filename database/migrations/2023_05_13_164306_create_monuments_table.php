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
        Schema::create('monuments', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('old_slug')->nullable();
            $table->json('name');
            $table->json('description')->nullable();
            $table->string('monument_image');
            $table->string('pin_image')->nullable();
            $table->decimal('latitude', $precision = 9, $scale = 6);
            $table->decimal('longitude', $precision = 9, $scale = 6);
            $table->string('phone_number')->nullable();
            $table->char('municipality_code', 4);
            $table->boolean('visible')->default(1);
            $table->timestamps();

            $table->foreign('municipality_code')->references('code')->on('municipalities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monuments');
    }
};
