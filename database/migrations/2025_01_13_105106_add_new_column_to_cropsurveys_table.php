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
        Schema::table('cropsurveys', function (Blueprint $table) {
            $table->unsignedTinyInteger('is_billed')->default(0)->after('crop_price'); // Corrected as a tiny integer for 0/1 values
            $table->text('review')->nullable()->after('is_billed'); // Allows null for review
            $table->unsignedTinyInteger('status')->default(1)->after('review'); // Default status as 1
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cropsurveys', function (Blueprint $table) {
            $table->dropColumn('review');
            $table->dropColumn('status');
        });
    }
};
