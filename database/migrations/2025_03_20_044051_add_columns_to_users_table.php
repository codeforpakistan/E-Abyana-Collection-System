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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('div_id')->nullable()->after('id');
            $table->unsignedBigInteger('district_id')->nullable()->after('div_id');
            $table->unsignedBigInteger('tehsil_id')->nullable()->after('district_id');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            
            $table->dropColumn(['div_id', 'district_id', 'tehsil_id']);

        });
    }
};
