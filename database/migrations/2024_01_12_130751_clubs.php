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
        Schema::create('clubs', function (Blueprint $table) {
                $table->id();
                $table->string('Name');
                $table->string('Funding_sources');
                $table->string('Registration_status');
                $table->string('Chairperson');
                $table->string('Contact');
                $table->json('Asset');
                $table->unsignedBigInteger('Capital');
                $table->string('QA_Contact');
                $table->unsignedBigInteger('Center_id');
                $table->rememberToken();
                $table->timestamps();

                $table->foreign('Center_id')->references('id')->on('centers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
