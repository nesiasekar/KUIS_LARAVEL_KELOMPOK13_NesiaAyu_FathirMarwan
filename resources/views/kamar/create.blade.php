@extends('layouts.app')

@section('title', 'Tambah Kamar Baru')

@section('content')
<div class="max-w-3xl mx-auto px-6">
    <div class="mb-8">
        <a href="{{ route('kamar.index') }}" class="text-indigo-600 font-semibold text-sm hover:text-indigo-800 transition-colors flex items-center gap-2 mb-2">
            ← Kembali ke Daftar Kamar
        </a>
        <h1 class="text-3xl font-black text-gray-900">Tambah Kamar Baru</h1>
        <p class="text-gray-500">Lengkapi formulir di bawah untuk menambahkan unit kamar baru ke sistem.</p>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8 md:p-10">
        <form action="{{ route('kamar.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Nomor Kamar</label>
                    <input type="text" name="nomor_kamar" value="{{ old('nomor_kamar') }}" 
                        placeholder="Contoh: A01"
                        class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all outline-none @error('nomor_kamar') border-red-500 @enderror">
                    @error('nomor_kamar')
                        <p class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Tipe Kamar</label>
                    <select name="tipe" class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all outline-none appearance-none">
                        <option value="standard">Standard</option>
                        <option value="deluxe">Deluxe</option>
                        <option value="vip">VIP</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Harga Bulanan (Rp)</label>
                    <input type="number" name="harga_bulanan" value="{{ old('harga_bulanan') }}" 
                        placeholder="Contoh: 500000"
                        class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all outline-none @error('harga_bulanan') border-red-500 @enderror">
                    @error('harga_bulanan')
                        <p class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Status Awal</label>
                    <select name="status" class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all outline-none appearance-none">
                        <option value="tersedia">Tersedia</option>
                        <option value="terisi">Terisi</option>
                    </select>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Fasilitas</label>
                <textarea name="fasilitas" rows="3" placeholder="Contoh: Kasur, Lemari, WiFi, Kamar Mandi Dalam"
                    class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all outline-none @error('fasilitas') border-red-500 @enderror">{{ old('fasilitas') }}</textarea>
                @error('fasilitas')
                    <p class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end gap-4 pt-4">
                <a href="{{ route('kamar.index') }}" class="px-8 py-4 text-gray-400 font-bold hover:text-gray-600 transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-10 py-4 bg-indigo-600 text-white font-black rounded-2xl hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition-all active:scale-95">
                    Simpan Unit Kamar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection