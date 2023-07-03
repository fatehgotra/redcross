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
        Schema::create('consents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('consent_to_be_contacted')->nullable();         
            $table->string('consent_to_background_check')->nullable();     
            $table->string('parental_consent')->nullable();                
            $table->string('media_consent')->nullable();                   
            $table->string('agree_to_code_of_conduct')->nullable();        
            $table->string('agree_to_child_protection_policy')->nullable();
            $table->string('age_under_18')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consents');
    }
};
