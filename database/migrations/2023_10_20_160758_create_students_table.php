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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('date_of_birth');
            $table->string('gender');
            $table->string('phone_number');
            $table->string('email');
            $table->unsignedBigInteger('center_id');
            $table->string('profile_picture');
            $table->string('birth_certificate');
            $table->string('letter');
            $table->string('status');
            $table->timestamps();
            $table->foreign('center_id')->references('id')->on('centers');
          
          
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};