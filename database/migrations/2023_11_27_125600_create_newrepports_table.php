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
        Schema::create('newrepports', function (Blueprint $table) {
            $table->id();
            $table->string('Title');
            $table->unsignedBigInteger('student');
            $table->unsignedBigInteger('course');
            $table->string('description');
            $table->string('attachment');
            $table->unsignedBigInteger('status')->nullable();
            $table->unsignedBigInteger('upload_user_id');
            $table->unsignedBigInteger('approve_user_id')->nullable();
            $table->string('comment')->nullable();
            $table->timestamps();

            $table->foreign('upload_user_id')->references('id')->on('users');
            $table->foreign('approve_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newrepports');
    }
};
