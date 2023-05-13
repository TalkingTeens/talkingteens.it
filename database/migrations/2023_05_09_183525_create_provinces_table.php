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
            $table->id();
            $table->tinyText('name');
            $table->char('code', 2);
            $table->decimal('latitude', $precision = 9, $scale = 6);
            $table->decimal('longitude', $precision = 9, $scale = 6);
            $table->integer('region_id');
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
