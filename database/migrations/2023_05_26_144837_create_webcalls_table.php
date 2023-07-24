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
        Schema::create('webcalls', function (Blueprint $table) {
            $table->id();
            $table->json('resources');
            $table->unsignedInteger('opened')->default(0);
            $table->unsignedInteger('started')->default(0);
            $table->unsignedInteger('closed')->default(0);
            $table->unsignedInteger('completed')->default(0);
            $table->foreignId('monument_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('webcalls');
    }
};
