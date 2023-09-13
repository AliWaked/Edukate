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
        Schema::create('profiles', function (Blueprint $table) {
            $table->foreignId('instructor_id')->unique()->constrained('instructors')->cascadeOnDelete();
            $table->string('avatar')->nullable();
            $table->string('job_title')->nullable();
            $table->string('birthday')->nullable();
            $table->enum('gender',['male','female']);
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            // $table->text('message')->nullable();
            $table->primary('instructor_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
