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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->enum('category', ['project', 'statues', 'activity', 'exercises']);
            $table->tinyText('picture'); // ->default(''); image placeholder
            $table->tinyText('resource');
            $table->tinyText('filename');
            $table->boolean('visible');
            $table->integer('opened')->default(0);
            $table->integer('downloads')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
