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
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('full_name')->virtualAs('concat(first_name, \' \', last_name)');
            $table->string('slug')->unique();
            $table->unsignedInteger('birth_year');
            $table->unsignedInteger('death_year')->nullable();
            $table->string('picture')->nullable();
            $table->json('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};
