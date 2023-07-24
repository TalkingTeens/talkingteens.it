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
        Schema::create('treatables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('treatable_id');
            $table->foreignId('monument_id')->constrained();
            $table->string("treatable_type");
            $table->text("description")->nullable();
            $table->string('photo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatables');
    }
};
