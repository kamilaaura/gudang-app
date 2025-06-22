<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Rename table lama
        Schema::rename('mutasis', 'mutasis_old');

        // Buat ulang tabel tanpa kolom lokasi_id
        Schema::create('mutasis', function ($table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('produk_id')->constrained('produks')->onDelete('cascade');
            $table->foreignId('lokasi_asal_id')->nullable()->constrained('lokasis')->onDelete('cascade');
            $table->foreignId('lokasi_tujuan_id')->nullable()->constrained('lokasis')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('jenis_mutasi');
            $table->integer('jumlah');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });

        // Salin data dari tabel lama ke tabel baru (kecuali lokasi_id)
        DB::statement("
            INSERT INTO mutasis (
                id, user_id, produk_id, lokasi_asal_id, lokasi_tujuan_id, tanggal, jenis_mutasi, jumlah, keterangan, created_at, updated_at
            )
            SELECT
                id, user_id, produk_id, lokasi_asal_id, lokasi_tujuan_id, tanggal, jenis_mutasi, jumlah, keterangan, created_at, updated_at
            FROM mutasis_old
        ");

        // Hapus tabel lama
        Schema::drop('mutasis_old');
    }

    public function down(): void
    {
        Schema::table('mutasis', function ($table) {
            $table->unsignedBigInteger('lokasi_id')->nullable();
        });
    }
};

