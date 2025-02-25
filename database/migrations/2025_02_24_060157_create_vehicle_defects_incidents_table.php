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
        Schema::create('vehicle_defects_incidents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_defect_id')->after('id');
            $table->foreign('vehicle_defect_id')->references('id')->on('vehicle_defect_lists')->onDelete('cascade');
            $table->enum('status',['0']);
            $table->datetime('incident_time');
            $table->string('notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_defects_incidents');
    }
};
