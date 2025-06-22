<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
   {
    Schema::table('mutasis', function (Blueprint $table) {
        $table->foreignId('lokasi_asal_id')->nullable()->constrained('lokasis');
        $table->foreignId('lokasi_tujuan_id')->nullable()->constrained('lokasis');
    });
   }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    Schema::table('mutasis', function (Blueprint $table) {
        $table->dropForeign(['lokasi_asal_id']);
        $table->dropColumn('lokasi_asal_id');
        $table->dropForeign(['lokasi_tujuan_id']);
        $table->dropColumn('lokasi_tujuan_id');
    });
    }
};
