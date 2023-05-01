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
        Schema::create('provinces', function (Blueprint $table) {
            $table->integer('istat_code')->primary();
            $table->char('iso_code', 2);
            $table->tinyText('name');
            $table->decimal('latitude', $precision = 8, $scale = 6);
            $table->decimal('longitude', $precision = 9, $scale = 6);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provinces');
    }
};
