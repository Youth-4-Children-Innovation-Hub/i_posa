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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('gender');
            $table->string('qualification');
            $table->string('ANFE_training');
            $table->string('email')->unique();
            $table->string('phone_number')->nullable();
            $table->unsignedBigInteger('created_by');
  
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};