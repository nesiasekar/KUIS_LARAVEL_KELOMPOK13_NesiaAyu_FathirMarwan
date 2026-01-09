<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Penyewa;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total_kamar = Kamar::count();
        $kamar_terisi = Kamar::where('status', 'terisi')->count();
        $kamar_tersedia = Kamar::where('status', 'tersedia')->count();
        $total_pendapatan = Pembayaran::where('status', 'lunas')->sum('jumlah_bayar');
        $pembayaran_tertunggak = Pembayaran::where('status', 'tertunggak')->count();

        $recent_kamars = Kamar::latest()->take(5)->get();

        return view('dashboard.index', compact(
            'total_kamar', 
            'kamar_terisi', 
            'kamar_tersedia', 
            'total_pendapatan', 
            'pembayaran_tertunggak',
            'recent_kamars'
        ));
    }
}