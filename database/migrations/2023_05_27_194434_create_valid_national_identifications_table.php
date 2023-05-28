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
        Schema::create('valid_national_identifications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('photo_id_card_type')->nullable();        
            $table->string('specify_photo_id_card_type')->nullable();
            $table->string('id_card_number')->nullable();            
            $table->date('id_expiry_date')->nullable();            
            $table->string('tin')->nullable();                       
            $table->string('photo_id')->nullable();                  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('valid_national_identifications');
    }
};
