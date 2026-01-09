@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-6">
    <div class="mb-8 text-center">
        <a href="{{ route('kontrak.create') }}" class="w-full block text-center py-4 bg-gray-900 text-white rounded-2xl font-bold hover:bg-black transition-all"> Buat Kontrak Baru ✍️</a>
        <p class="text-gray-500 text-lg">Hubungkan penyewa dengan kamar pilihan mereka.</p>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-indigo-50 border border-gray-100 p-8 md:p-12">
        <form action="{{ route('kontrak.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-3">
                    <label class="block text-sm font-bold text-gray-400 uppercase tracking-widest">Pilih Penyewa</label>
                    <select name="penyewa_id" class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-4 focus:ring-indigo-100 outline-none transition-all">
                        <option value="">-- Pilih Nama --</option>
                        @foreach($penyewas as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_lengkap }} ({{ $p->pekerjaan }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-3">
                    <label class="block text-sm font-bold text-gray-400 uppercase tracking-widest">Pilih Kamar (Tersedia)</label>
                    <select name="kamar_id" class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-4 focus:ring-indigo-100 outline-none transition-all">
                        <option value="">-- Nomor Kamar --</option>
                        @foreach($kamars as $k)
                            <option value="{{ $k->id }}">Kamar {{ $k->nomor_kamar }} - Rp{{ number_format($k->harga_bulanan) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-3">
                    <label class="block text-sm font-bold text-gray-400 uppercase tracking-widest">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-4 focus:ring-indigo-100 outline-none transition-all">
                </div>

                <div class="space-y-3">
                    <label class="block text-sm font-bold text-gray-400 uppercase tracking-widest">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-4 focus:ring-indigo-100 outline-none transition-all">
                </div>
            </div>

            <div class="space-y-3">
                <label class="block text-sm font-bold text-gray-400 uppercase tracking-widest">Harga Disepakati (Per Bulan)</label>
                <input type="number" name="harga_bulanan" placeholder="Masukkan nominal harga..." class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-4 focus:ring-indigo-100 outline-none transition-all">
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full py-5 bg-indigo-600 text-white font-black text-lg rounded-3xl hover:bg-indigo-700 shadow-xl shadow-indigo-100 hover:scale-[1.02] active:scale-95 transition-all">
                    Konfirmasi Kontrak Sewa Baru 
                </button>
            </div>
        </form>
    </div>
</div>
@endsection