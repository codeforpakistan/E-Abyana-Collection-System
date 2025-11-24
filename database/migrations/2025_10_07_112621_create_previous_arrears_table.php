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
    public function up(): void
    {
        Schema::create('previous_arrears', function (Blueprint $table) {
            $table->id();
            $table->float('previous_arrears', 10, 2);
            $table->unsignedBigInteger('irrigator_id');
            $table->unsignedBigInteger('div_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('previous_arrears');
    }
};
