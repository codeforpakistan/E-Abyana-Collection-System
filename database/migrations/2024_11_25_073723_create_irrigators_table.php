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
        Schema::create('irrigators', function (Blueprint $table) {
            $table->id();
            $table->integer('village_id');
            $table->integer('canal_id');
            $table->string('irrigator_name');
            $table->string('irrigator_khata_number');
            $table->string('irrigator_f_name');
            $table->string('irrigator_mobile_number');
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
        Schema::dropIfExists('irrigators');
    }
};
