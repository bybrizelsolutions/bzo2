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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('vehicle_type');
            $table->string('registration');
            $table->string('make');
            $table->string('model');
            $table->dateTime('purchase_date');
            $table->dateTime('purchase_from');
            $table->dateTime('service_by');
            $table->dateTime('notes');
            $table->dateTime('mileage')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
