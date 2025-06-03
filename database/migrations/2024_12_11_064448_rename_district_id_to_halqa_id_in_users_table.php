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
            // Add the new column
            $table->unsignedBigInteger('halqa_id')->nullable()->after('district_id');
        });

        // Copy data from `district_id` to `halqa_id`
        \DB::statement('UPDATE users SET halqa_id = district_id');

        Schema::table('users', function (Blueprint $table) {
            // Drop the old column
            $table->dropColumn('district_id');
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
            // Add the old column back
            $table->unsignedBigInteger('district_id')->nullable()->after('halqa_id');
        });

        // Copy data from `halqa_id` back to `district_id`
        \DB::statement('UPDATE users SET district_id = halqa_id');

        Schema::table('users', function (Blueprint $table) {
            // Drop the new column
            $table->dropColumn('halqa_id');
        });
    }
};
