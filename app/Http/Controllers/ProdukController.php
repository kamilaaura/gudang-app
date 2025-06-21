<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        return Produk::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_produk' => 'required|string|max:100',
            'kode_produk' => 'required|string|max:50|unique:produks',
            'kategori' => 'required|string',
            'satuan' => 'required|string',
        ]);

        return Produk::create($data);
    }

    public function show(Produk $produk)
    {
        return $produk;
    }

    public function update(Request $request, Produk $produk)
    {
        $data = $request->validate([
            'nama_produk' => 'sometimes|string|max:100',
            'kode_produk' => 'sometimes|string|max:50|unique:produks,kode_produk,' . $produk->id,
            'kategori' => 'sometimes|string',
            'satuan' => 'sometimes|string',
        ]);

        $produk->update($data);
        return $produk;
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();
        return response()->json(['message' => 'Produk deleted']);
    }
}
