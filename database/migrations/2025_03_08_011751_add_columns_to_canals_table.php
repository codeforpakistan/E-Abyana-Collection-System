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
        Schema::table('canals', function (Blueprint $table) {
            $table->unsignedBigInteger('div_id')->nullable();
            $table->integer('no_outlet')->nullable();
            $table->integer('no_outlet_ls')->nullable();
            $table->integer('no_outlet_rs')->nullable();
            $table->integer('total_no_cca')->nullable();
            $table->integer('total_no_discharge_cusic')->nullable();
        });
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('canals', function (Blueprint $table) {
            $table->dropColumn(['div_id', 'no_outlet', 'no_outlet_ls', 'no_outlet_rs', 'total_no_cca', 'total_no_discharge_cusic']);
        });
    
    }
};
