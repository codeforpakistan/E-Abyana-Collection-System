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
        Schema::table('outlets', function (Blueprint $table) {
          
            $table->unsignedBigInteger('div_id')->nullable();
            $table->unsignedBigInteger('minor_id')->nullable();
            $table->unsignedBigInteger('distrib_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->integer('beneficiaries')->nullable();
            $table->integer('total_no_discharge_cusic')->nullable();
            $table->integer('total_no_cca')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('outlets', function (Blueprint $table) {
            $table->dropColumn(['div_id', 'canal_id', 'minor_id', 'distrib_id','branch_id', 'beneficiaries', 'total_no_discharge_cusic','total_no_cca']);
        });
    }
};
