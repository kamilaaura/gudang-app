<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\Produk;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class MutasiController extends Controller
{
    public function index()
    {
        return Mutasi::with(['user', 'produk', 'lokasi'])->get();
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'kode_lokasi' => 'required|unique:lokasis',
        'nama_lokasi' => 'required',
    ]);

    $lokasi = new \App\Models\Lokasi();
    $lokasi->kode_lokasi = $validated['kode_lokasi'];
    $lokasi->nama_lokasi = $validated['nama_lokasi'];
    $lokasi->save();

    return response()->json($lokasi, 201);
}

    public function show($id)
    {
        return Mutasi::with(['user', 'produk', 'lokasi'])->findOrFail($id);
    }

    public function destroy($id)
    {
        Mutasi::findOrFail($id)->delete();
        return response()->json(['message' => 'Mutasi deleted']);
    }

    // History berdasarkan Produk
    public function historyByProduk($id)
    {
        return Mutasi::where('produk_id', $id)->with('user')->get();
    }

    // History berdasarkan User
    public function historyByUser($id)
    {
        return Mutasi::where('user_id', $id)->with('produk', 'lokasi')->get();
    }
}
