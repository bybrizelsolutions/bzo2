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
        Schema::create('vehicle_incidents_images', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->notNullable();
            $table->unsignedBigInteger('file_id')->after('id');
            $table->foreign('file_id')->references('id')->on('file_file')->onDelete('cascade');
            $table->unsignedBigInteger('api_incident_id')->after('file_id');
            $table->foreign('api_incident_id')->references('id')->on('api_incident')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_incidents_images');
    }
};
