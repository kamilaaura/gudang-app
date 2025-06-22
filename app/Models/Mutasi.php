<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mutasi extends Model
{
   protected $fillable = [
    'user_id',
    'produk_id',
    'lokasi_asal_id',
    'lokasi_tujuan_id',
    'tanggal',
    'jenis_mutasi',
    'jumlah',
    'keterangan'
   ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class);
    }

    public function lokasiAsal(): BelongsTo
   {
    return $this->belongsTo(Lokasi::class, 'lokasi_asal_id');
   }

   public function lokasiTujuan(): BelongsTo
   {
    return $this->belongsTo(Lokasi::class, 'lokasi_tujuan_id');
   }
}
