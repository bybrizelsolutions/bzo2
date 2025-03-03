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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('address_id')->after('id');
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');
            $table->unsignedBigInteger('area_id')->after('address_id');
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
            $table->unsignedBigInteger('country_id')->after('area_id');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->unsignedBigInteger('sic_code_id')->after('country_id');
            $table->foreign('sic_code_id')->references('id')->on('sic_codes')->onDelete('cascade');
            $table->unsignedBigInteger('division_of')->nullable();
            $table->enum('client_type',['0','1'])->default('0')->comment('0: Client, 1: Group');
            $table->enum('consignment_type',['1','2'])->default('1')->comment('0: ship, 1: status');
            $table->string('name');
            $table->string('phone');
            $table->string('contact_name');
            $table->string('fax_number')->nullable();
            $table->string('website')->nullable();
            $table->enum('source',['1','2','3','4','5','6','7','8'])->default('1')->comment('1: ship, 2: status, 3: status, 4: status, 5: status, 6: status, 7: status, 8: status');
            $table->string('notes');
            $table->string('specify')->nullable();
            $table->string('premise_code');
            $table->enum('is_expiry',['0','1'])->default('0')->comment('0: false, 1: false');
            $table->boolean('is_price')->default(0)->comment('0: none, 1: price exist');
            $table->dateTime('expiry_date')->nullable();
            $table->smallInteger('is_dormant')->default(0);
            $table->dateTime('created_dormant')->nullable();
            $table->boolean('auto_info_expiry')->default(0);
            $table->string('site_email');
            $table->string('contract_email');
            $table->integer('tab_index')->nullable();
            $table->string('account_number');
            $table->string('sage_account_number');
            $table->string('contract_kpi_tanker');
            $table->string('contract_kpi_box');
            $table->string('ad_hoc_kpi_tanker');
            $table->string('ad_hoc_kpi_box');
            $table->string('contract_tanker_number');
            $table->string('contract_box_number');
            $table->string('ad_hoc_tanker_number');
            $table->string('ad_hoc_box_number');
            $table->string('email');
            $table->string('consignment_note_re');
            $table->smallInteger('is_consignment_note')->default(0);
            $table->integer('steps')->nullable();
            $table->integer('standard_price')->nullable();
            $table->integer('covid_closed')->nullable();
            $table->smallInteger('prevent_group_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
