<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Penyewa;
use App\Models\KontrakSewa;
use Illuminate\Http\Request;

class KontrakSewaController extends Controller
{
    public function index()
    {
        $kontraks = KontrakSewa::with(['penyewa', 'kamar'])->latest()->get();
        return view('kontrak.index', compact('kontraks'));
    }

    public function create()
    {
        $penyewas = Penyewa::all();
        $kamars = Kamar::where('status', 'tersedia')->get();

        return view('kontrak.create', compact('penyewas', 'kamars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'penyewa_id'     => 'required|exists:penyewa,id',
            'kamar_id'       => 'required|exists:kamar,id',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'harga_bulanan'   => 'required|numeric|min:0',
        ]);

        KontrakSewa::create([
            'penyewa_id'     => $request->penyewa_id,
            'kamar_id'       => $request->kamar_id,
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'harga_bulanan'   => $request->harga_bulanan,
            'status'         => 'aktif',
        ]);

        Kamar::where('id', $request->kamar_id)->update(['status' => 'terisi']);

        return redirect()->route('dashboard')->with('success', 'Kontrak Berhasil Dibuat');
    }

    public function show(string $id)
    {
        $kontrak = KontrakSewa::with(['penyewa', 'kamar', 'pembayaran'])->findOrFail($id);
        return view('kontrak.show', compact('kontrak'));
    }

    public function edit(string $id)
    {
        $kontrak = KontrakSewa::findOrFail($id);
        return view('kontrak.edit', compact('kontrak'));
    }

    public function update(Request $request, string $id)
    {
        $kontrak = KontrakSewa::findOrFail($id);
        $kontrak->update($request->all());
        return redirect()->route('kontrak.index');
    }

    public function destroy(string $id)
    {
        KontrakSewa::destroy($id);
        return redirect()->route('kontrak.index');
    }
}