<?php


namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LokasiController extends Controller
{
    public function index()
    {
        return Lokasi::all();
    }

public function store(Request $request)
{
    Log::info('Masuk ke LokasiController@store', ['request' => $request->all()]);
    
    $request->validate([
        'kode_lokasi' => 'required|unique:lokasis',
        'nama_lokasi' => 'required',
    ]);

    $lokasi = Lokasi::create($request->all());

    Log::info('Lokasi berhasil dibuat', ['lokasi' => $lokasi]);

    return $lokasi;
}

    public function show($id)
    {
        return Lokasi::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $lokasi = Lokasi::findOrFail($id);
        $lokasi->update($request->all());

        return $lokasi;
    }

    public function destroy($id)
    {
        Lokasi::findOrFail($id)->delete();
        return response()->json(['message' => 'Lokasi deleted']);
    }
}
