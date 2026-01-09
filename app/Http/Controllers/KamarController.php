<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{

    public function index()
    {
        $kamars = Kamar::latest()->get();
        return view('kamar.index', compact('kamars'));
    }

    public function create()
{
    // Ini fungsi untuk menampilkan halaman form (blade yang Anda kirim)
    return view('kamar.create');
}

public function store(Request $request)
{
    $request->validate([
        'nomor_kamar'   => 'required|unique:kamar,nomor_kamar|max:10',
        'tipe'          => 'required',
        'harga_bulanan' => 'required|numeric|min:0',
        'fasilitas'     => 'required',
        'status'        => 'required'
    ]);

    \App\Models\Kamar::create([
        'nomor_kamar'   => $request->nomor_kamar,
        'tipe'          => $request->tipe,
        'harga_bulanan' => $request->harga_bulanan,
        'fasilitas'     => $request->fasilitas,
        'status'        => $request->status,
    ]);

    return redirect()->route('kamar.index')->with('success', 'Kamar berhasil ditambahkan!');
    }

   
    public function destroy(Kamar $kamar)
    {
        $kamar->delete();
        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil dihapus!');
    }
}