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
        Schema::create('cropsurveys', function (Blueprint $table) {
            $table->id('crop_survey_id');



            $table->string('khasra_number');
            $table->string('tenant_name');
            $table->date('registration_date');
            
            $table->text('cultivators_info');
            $table->text('snowing_date');
            
            $table->string('land_assessment_marla');
            $table->string('land_assessment_kanal');
            $table->string('previous_crop');
            $table->date('date')->nullable();
            $table->string('width')->nullable();
            $table->string('length')->nullable();
          
       
           
        
          
            $table->integer('area_marla')->nullable();
            $table->integer('area_kanal')->nullable();
            $table->string('final_crop')->nullable(); //maybe final_crop_id
      
            $table->string('double_crop_marla');
            $table->string('double_crop_kanal');
            $table->string('identifable_area_marla');
            $table->string('identifable_area_kanal');
            $table->string('irrigated_area_marla');
            $table->string('irrigated_area_kanal');
            $table->string('land_quality');
            $table->string('irrigator_khata_number');
            $table->unsignedBigInteger('village_id');
            $table->unsignedBigInteger('irrigator_id');
            $table->unsignedBigInteger('canal_id');
            $table->unsignedBigInteger('minor_id')->nullable();
            $table->unsignedBigInteger('distri_id')->nullable();
             $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedBigInteger('crop_id');
            $table->unsignedBigInteger('outlet_id');
    
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
        Schema::dropIfExists('cropsurveys');
    }
};
