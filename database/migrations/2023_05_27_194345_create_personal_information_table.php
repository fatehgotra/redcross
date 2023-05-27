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
        Schema::create('personal_information', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('lastname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('other_names')->nullable();
            $table->string('father_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('sex')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('specify_citizenship')->nullable();
            $table->string('ethnic_background')->nullable();
            $table->text('specify_ethnic_background')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('no_of_dependents')->nullable();
            $table->string('languages_spoken')->nullable();
            $table->text('specify_languages_spoken')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_information');
    }
};
