<?php

namespace App\Http\Controllers;

use App\Models\Penyewa;
use Illuminate\Http\Request;

class PenyewaController extends Controller
{
    public function index()
    {
        $penyewas = Penyewa::all();
        return view('penyewa.index', compact('penyewas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'nomor_telepon' => 'required|string|max:15',
            'nomor_ktp' => 'required|string|unique:penyewa,nomor_ktp',
            'alamat_asal' => 'required',
            'pekerjaan' => 'required',
        ]);

        Penyewa::create($request->all());
        return redirect()->back()->with('success', 'Penyewa berhasil ditambahkan');
    }

    public function destroy($id)
    {
    $penyewa = \App\Models\Penyewa::findOrFail($id);
    if ($penyewa->kontrakSewa()->exists()) {
        return redirect()->back()->with('error', 'Penyewa tidak bisa dihapus karena masih memiliki riwayat kontrak sewa!');
    }

    $penyewa->delete();
    return redirect()->route('penyewa.index')->with('success', 'Data penyewa berhasil dihapus');
    }
}