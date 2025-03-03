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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prd_default_consignment_note_type');
            $table->unsignedBigInteger('prd_hazard_codes_id');
            $table->unsignedBigInteger('consignment_category_id');
            $table->unsignedBigInteger('prd_physical_form_id');
            $table->string('name');
            $table->string('short_name');
            $table->unsignedTinyInteger('category');
            $table->decimal('base_price_one', 10, 2)->notNullable();
            $table->string('size');
            $table->unsignedTinyInteger('vehicle_type');
            $table->longText('instructions')->nullable();
            $table->unsignedTinyInteger('service_type');
            $table->string('prd_ewc_code');
            $table->string('prd_component');
            $table->unsignedTinyInteger('pence_flag');
            $table->double('full_weight')->nullable();
            $table->double('empty_weight')->nullable();
            $table->unsignedTinyInteger('h2o');
            $table->double('cl')->nullable();
            $table->double('s')->nullable();
            $table->unsignedTinyInteger('solid');
            $table->string('fp');
            $table->double('ash')->nullable();
            $table->unsignedTinyInteger('vehicle_and_man_hire')->default(0);
            $table->unsignedTinyInteger('per_tonne_disposal')->default(0);
            $table->unsignedTinyInteger('service_check');
            $table->enum('status',['0','1','2','3'])->default('0')->comment('0: active, 1: deactivated, 2: suspended, 3: deleted');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('prd_default_consignment_note_type')->references('id')->on('product_consignment_note_types')->onDelete('cascade');
            $table->foreign('prd_hazard_codes_id')->references('id')->on('product_hazard_codes')->onDelete('cascade');
            $table->foreign('consignment_category_id')->references('id')->on('product_consignment_categories')->onDelete('cascade');
            $table->foreign('prd_physical_form_id')->references('id')->on('product_physical_forms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
