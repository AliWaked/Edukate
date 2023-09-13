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
        Schema::create('article_translations', function (Blueprint $table) {
            // mandatory fields
            $table->id('id'); // Laravel 5.8+ use bigIncrements() instead of increments()
            $table->string('locale')->index();

            // Foreign key to the main model
            $table->foreignId('article_id')->constrained('articles')->cascadeOnDelete();
            $table->unique(['article_id', 'locale']);
            // $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');

            // Actual fields you want to translate
            $table->string('title');
            $table->longText('full_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_translations');
    }
};
