<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmers', function (Blueprint $table) {
        
            $table->id('farmer_id');
            $table->string('serial_number');
            $table->date('registration_date');
            $table->string('assessment_number');
            $table->string('patwari_name');
            $table->string('owner_name');
            $table->string('tenant_name');
            $table->text('cultivators_info');
            $table->integer('marla');
            $table->integer('kanal');
            $table->string('previous_crop');
            $table->date('snowing_date');
            $table->unsignedBigInteger('village_id');
            $table->unsignedBigInteger('division_id');
            $table->unsignedBigInteger('tehsil_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('canal_id');
            $table->unsignedBigInteger('crop_id');
            $table->unsignedBigInteger('outlet_id');
            $table->string('water_outlet');
            $table->string('plat_boundary_number');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farmers');
    }
};
