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
        Schema::create('galleries_multimedias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gallery_id')->constrained('galleries', 'id');
            $table->foreignId('multimedia_id')->constrained('multimedias', 'id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries_multimedias');
    }
};
