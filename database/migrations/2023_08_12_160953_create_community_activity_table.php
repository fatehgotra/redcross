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
        Schema::create('community_activity', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('breif')->nullable();
            $table->unsignedBigInteger('submit_by');
            $table->unsignedBigInteger('submit_to');
            $table->enum('status',['Pending','Approved'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community_activity');
    }
};
