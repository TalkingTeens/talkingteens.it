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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->enum('grade', [1, 2, 3, 4, 5]);
            $table->char('section', 1)->nullable();
            $table->string("discipline")->nullable();
            $table->char('year', 7);
            $table->string('school_miur_code');
            $table->timestamps();

            $table->foreign('school_miur_code')->references('miur_code')->on('schools');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
