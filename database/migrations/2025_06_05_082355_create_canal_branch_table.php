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
        Schema::create('canal_branch', function (Blueprint $table) {
            $table->id();
            $table->string('branch_name'); 
            $table->unsignedBigInteger('canal_id')->nullable();
            $table->unsignedBigInteger('div_id')->nullable();
            $table->unsignedBigInteger('minor_id')->nullable();
            $table->unsignedBigInteger('distrib_id')->nullable();
            $table->integer('no_outlet')->nullable();
            $table->integer('no_outlet_ls')->nullable();
            $table->integer('no_outlet_rs')->nullable();
            $table->integer('total_no_cca')->nullable();
            $table->integer('total_no_discharge_cusic')->nullable();
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
        Schema::dropIfExists('canal_branch');
    }
};
