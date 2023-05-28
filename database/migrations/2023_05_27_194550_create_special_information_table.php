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
        Schema::create('special_information', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('any_police_records')->nullable();        
            $table->text('any_special_needs')->nullable();         
            $table->string('specify_special_needs')->nullable();     
            $table->string('any_medical_conditions')->nullable();    
            $table->text('specify_medical_conditions')->nullable();
            $table->string('know_how_to_swim')->nullable();          
            $table->string('full_covid_vaccination')->nullable();    
            $table->string('date_first_vaccine')->nullable();        
            $table->string('date_second_vaccine')->nullable();       
            $table->string('date_booster')->nullable();              
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_information');
    }
};
