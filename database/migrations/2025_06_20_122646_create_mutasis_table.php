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
    Schema::create('mutasis', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('produk_id')->constrained()->onDelete('cascade');
        $table->foreignId('lokasi_id')->constrained()->onDelete('cascade');
        $table->date('tanggal');
        $table->enum('jenis_mutasi', ['masuk', 'keluar']);
        $table->integer('jumlah');
        $table->string('keterangan')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasis');
    }
};
