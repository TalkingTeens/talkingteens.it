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
        Schema::create('schools', function (Blueprint $table) {
            $table->string('miur_code');
            $table->string('name');
            $table->string('main_miur_code');
            $table->string('main_name');
            $table->string('address')->nullable();
            $table->unsignedInteger('cap')->nullable();
            $table->char('municipality_code', 4);
            $table->string('characteristics');
            $table->string('type');
            $table->string('email')->nullable();
            $table->string('pec')->nullable();
            $table->string('website')->nullable();
            $table->timestamps();

            $table->primary('miur_code');
            $table->foreign('municipality_code')->references('code')->on('municipalities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
