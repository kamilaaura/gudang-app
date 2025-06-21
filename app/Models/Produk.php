<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Produk extends Model
{
    protected $fillable = ['nama_produk', 'kode_produk', 'kategori', 'satuan'];

    public function lokasi(): BelongsToMany
    {
        return $this->belongsToMany(Lokasi::class, 'lokasi_produk')
                    ->withPivot('stok')
                    ->withTimestamps();
    }

    public function mutasi()
    {
        return $this->hasMany(Mutasi::class);
    }
}
