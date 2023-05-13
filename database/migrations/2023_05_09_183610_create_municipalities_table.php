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
            $table->id();
            $table->tinyText('name');
            $table->char('code', 4);
            $table->decimal('latitude', $precision = 9, $scale = 6);
            $table->decimal('longitude', $precision = 9, $scale = 6);
            $table->integer('province_id');
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
