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
        Schema::create('contact_information', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('resedential_address')->nullable();            
            $table->string('community_name')->nullable();                 
            $table->string('community_type')->nullable();                 
            $table->string('province')->nullable();                       
            $table->string('district')->nullable();                       
            $table->text('postal_address')->nullable();                 
            $table->string('email')->nullable();                          
            $table->string('landline_contact')->nullable();               
            $table->string('primary_mobile_contact_number')->nullable();  
            $table->string('primary_mobile_network_provider')->nullable();
            $table->string('other_contact_numbers')->nullable();          
            $table->string('full_name_of_emergency_contact')->nullable(); 
            $table->string('relationship')->nullable();                   
            $table->text('resedential_address_separate')->nullable();   
            $table->string('contact_number')->nullable();                 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_information');
    }
};
