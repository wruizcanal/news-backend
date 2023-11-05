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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title')->unique();
            $table->text('summary');
            $table->longText('content');
            $table->enum('status', ['Saved','Published']);
            $table->tinyInteger('open_close');
            $table->date('published_date');
            $table->foreignId('category_id')->constrained('categories', 'id');
            $table->foreignId('cover_picture')->constrained('multimedias', 'id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
