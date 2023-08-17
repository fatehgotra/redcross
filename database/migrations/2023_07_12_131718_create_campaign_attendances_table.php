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
        Schema::create('campaign_attendances', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('campaign_id')->unsigned()->index()->nullable();
            $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');
            $table->string('starts_at');
            $table->string('ends_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_attendances');
    }
};
