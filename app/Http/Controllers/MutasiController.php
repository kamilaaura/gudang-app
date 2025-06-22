<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use Illuminate\Http\Request;

class MutasiController extends Controller
{
    // Tampilkan semua mutasi dengan relasi
    public function index()
    {
        return Mutasi::with(['user', 'produk', 'lokasiAsal', 'lokasiTujuan'])->get();
    }

    // Simpan mutasi baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'produk_id' => 'required|exists:produks,id',
            'lokasi_asal_id' => 'required|exists:lokasis,id',
            'lokasi_tujuan_id' => 'required|exists:lokasis,id',
            'tanggal' => 'required|date',
            'jenis_mutasi' => 'required|in:masuk,keluar,pindah',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string'
        ]);

        $mutasi = Mutasi::create($validated);

        return response()->json($mutasi, 201);
    }

    // Tampilkan detail mutasi
    public function show($id)
    {
        return Mutasi::with(['user', 'produk', 'lokasiAsal', 'lokasiTujuan'])->findOrFail($id);
    }

    // Hapus mutasi
    public function destroy($id)
    {
        Mutasi::findOrFail($id)->delete();
        return response()->json(['message' => 'Mutasi deleted']);
    }

    // History berdasarkan Produk
    public function historyByProduk($id)
    {
        return Mutasi::where('produk_id', $id)->with(['user', 'lokasiAsal', 'lokasiTujuan'])->get();
    }

    // History berdasarkan User
    public function historyByUser($id)
    {
            return Mutasi::where('user_id', $id)
        ->with(['produk', 'lokasiAsal', 'lokasiTujuan'])
        ->get();
    }
}
