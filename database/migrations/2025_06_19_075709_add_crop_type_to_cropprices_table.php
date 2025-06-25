<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cropprices', function (Blueprint $table) {
            $table->enum('crop_type', ['Cash Crop', 'Non-Cash Crop'])
                  ->default('Cash Crop')
                  ->after('final_crop');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cropprices', function (Blueprint $table) {
            $table->dropColumn('crop_type');
        });
    }
};
