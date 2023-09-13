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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('descriptions');
            $table->string('course_image');
            $table->string('language');
            $table->string('slug')->unique();
            $table->enum('skill_level', ['beginners', 'intermediate', 'advanced', 'all level'])->default('all level');
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->morphs('user');
            // $table->foreignId('instructor_id')->constrained('instructors')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
