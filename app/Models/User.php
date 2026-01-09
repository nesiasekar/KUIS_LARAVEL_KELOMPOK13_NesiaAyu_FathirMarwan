<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total_kamar = Kamar::count();
        $kamar_terisi = Kamar::where('status', 'terisi')->count();
        $kamar_tersedia = Kamar::where('status', 'tersedia')->count();

        $total_pendapatan = Pembayaran::where('status', 'lunas')
            ->whereMonth('tanggal_bayar', now()->month)
            ->sum('jumlah_bayar');
            
        $pembayaran_tertunggak = Pembayaran::where('status', 'tertunggak')->count();

        return view('dashboard.index', compact(
            'total_kamar', 
            'kamar_terisi', 
            'kamar_tersedia', 
            'total_pendapatan', 
            'pembayaran_tertunggak'
        ));
    }
}