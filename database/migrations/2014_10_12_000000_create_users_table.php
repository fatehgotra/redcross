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
        Schema::create('users', function (Blueprint $table) {
            $table->id();           
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->nullable();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->string('country')->nullable();
            $table->enum('status', ['pending', 'approve', 'decline'])->default('pending');
            $table->enum('approved_by', ['Administrator', 'Branch Level', 'Division Manager', 'HQ'])->nullable();
            $table->bigInteger('approver_id')->unsigned()->nullable();
            $table->text('decline_reason')->nullable();
            $table->string('role')->nullable();
            $table->string('branch')->nullable();
            $table->date('expiry_date')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
