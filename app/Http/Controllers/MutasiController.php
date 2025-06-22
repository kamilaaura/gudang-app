<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;


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
    Log::info('Masuk ke MutasiController@store', ['request' => $request->all()]);
    try {
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
    } catch (\Exception $e) {
        Log::error('Gagal menyimpan mutasi', ['error' => $e->getMessage()]);
        return response()->json([
            'message' => 'Error saat menyimpan mutasi',
            'error' => $e->getMessage(),
        ], 500);
    }
}

public function update(Request $request, $id)
{
    try {
        $mutasi = Mutasi::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'produk_id' => 'sometimes|exists:produks,id',
            'lokasi_asal_id' => 'sometimes|exists:lokasis,id',
            'lokasi_tujuan_id' => 'sometimes|exists:lokasis,id',
            'tanggal' => 'sometimes|date',
            'jenis_mutasi' => 'sometimes|in:masuk,keluar,pindah',
            'jumlah' => 'sometimes|integer|min:1',
            'keterangan' => 'nullable|string'
        ]);

        $mutasi->update($validated);

        return response()->json([
            'message' => 'Mutasi berhasil diperbarui',
            'data' => $mutasi
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Gagal memperbarui mutasi',
            'error' => $e->getMessage()
        ], 500);
    }
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
