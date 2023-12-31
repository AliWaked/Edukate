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
        Schema::create('section_translation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained('sections')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('lesson_title');
            $table->json('lectures');
            $table->json('attachments')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_translation');
    }
};
