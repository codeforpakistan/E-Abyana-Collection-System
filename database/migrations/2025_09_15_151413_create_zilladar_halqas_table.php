<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('zilladar_halqas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('halqa_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('zilladar_halqas');
    }
};
