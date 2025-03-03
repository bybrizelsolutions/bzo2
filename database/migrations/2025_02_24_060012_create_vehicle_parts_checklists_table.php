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
        Schema::create('vehicle_parts_checklists', function (Blueprint $table) {
            $table->id();
            $table->string('checklist_name');
            $table->unsignedBigInteger('vehicle_type_id')->default(1);
            $table->foreign('vehicle_type_id')->references('id')->on('vehicle_types')->onDelete('cascade');
            $table->string('notes');
            $table->enum('status',['0','1','2','3'])->default('0')->comment('0: active, 1: deactivated, 2: suspended, 3: deleted');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_parts_checklists');
    }
};
