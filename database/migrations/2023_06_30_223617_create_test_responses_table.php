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
        Schema::create('test_responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('test_attempt_id');
            $table->foreign('test_attempt_id')->references('id')->on('test_attempts')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');           
            $table->unsignedBigInteger('question_id');
            $table->enum('attempted',[ 'yes', 'no'])->default('no');
            $table->unsignedBigInteger('option')->nullable();
            $table->enum('correct',[ 'yes', 'no'])->default('no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_responses');
    }
};
