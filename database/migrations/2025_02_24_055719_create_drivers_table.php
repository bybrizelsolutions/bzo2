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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email_address');
            $table->string('home_phone');
            $table->string('work_mobile');
            $table->string('personal_mobile');
            $table->dateTime('dob')->nullable()->default(null);
            $table->longText('notes')->nullable();
            $table->smallInteger('drives_box_vehicles')->nullable();
            $table->smallInteger('drives_tankers')->nullable();
            $table->string('phone_number');
            $table->string('mobile_number');
            $table->string('relationship');
            $table->string('device_id');
            $table->integer('pin')->nullable();
            $table->string('signature', 2048)->nullable();
            $table->unsignedBigInteger('address_id')->after('id');
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');
            $table->unsignedBigInteger('country_id')->after('address_id');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->unsignedBigInteger('kin_address_id')->after('country_id');
            $table->foreign('kin_address_id')->references('id')->on('addresses')->onDelete('cascade');
            $table->unsignedBigInteger('kin_country_id')->after('kin_address_id');
            $table->foreign('kin_country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->enum('status',['0','1','2','3'])->default('0')->comment('0: active, 1: deactivated, 2: suspended, 3: deleted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
