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
        Schema::create('municipalities', function (Blueprint $table) {
            $table->char('code', 4);
            $table->unsignedInteger('istat_code');
            $table->string('name');
            $table->decimal('latitude', $precision = 9, $scale = 6)->nullable();
            $table->decimal('longitude', $precision = 9, $scale = 6)->nullable();
            $table->unsignedBigInteger('province_id');

            $table->primary('code');
            $table->foreign('province_id')->references('id')->on('provinces');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('municipalities');
    }
};
