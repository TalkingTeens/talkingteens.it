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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->enum('category', ['project', 'statues', 'activity', 'exercises']);
            $table->string('picture')->nullable();
            $table->string('resource');
            $table->string('filename');
            $table->boolean('visible')->default(1);
            $table->unsignedBigInteger('opened')->default(0);
            $table->unsignedBigInteger('downloads')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
