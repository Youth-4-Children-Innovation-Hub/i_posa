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
            $table->integer('age');
            $table->string('gender');
            $table->unsignedBigInteger('center_id');
            $table->unsignedBigInteger('region_id');
            $table->string('profile_picture');
            $table->string('birth_certificate');
            $table->string('letter');
            $table->timestamps();
            $table->foreign('center_id')->references('id')->on('centers');
            $table->foreign('region_id')->references('id')->on('regions');
          
          
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