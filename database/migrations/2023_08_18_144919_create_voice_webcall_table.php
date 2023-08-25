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
        Schema::create('voice_webcall', function (Blueprint $table) {
//            $table->id();
            $table->foreignId('voice_id')->constrained();
            $table->foreignId('webcall_id')->constrained();

            $table->primary(['voice_id', 'webcall_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voice_webcall');
    }
};
