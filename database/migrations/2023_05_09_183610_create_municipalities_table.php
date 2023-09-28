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
            $table->json('description')->nullable();
            $table->decimal('latitude', $precision = 9, $scale = 6)->nullable();
            $table->decimal('longitude', $precision = 9, $scale = 6)->nullable();
            $table->foreignId('province_id')->constrained();

            $table->primary('code');
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
