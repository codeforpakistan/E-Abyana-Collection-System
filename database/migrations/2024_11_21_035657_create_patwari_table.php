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
        Schema::create('patwari', function (Blueprint $table) {
            $table->id('patwari_id');
            $table->string('patwari_name'); 
            $table->string('patwari_cnic')->unique();
            $table->unsignedBigInteger('halqa_id')->constrained('halqa')->onDelete('cascade');
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
        Schema::dropIfExists('patwari');
    }
};
