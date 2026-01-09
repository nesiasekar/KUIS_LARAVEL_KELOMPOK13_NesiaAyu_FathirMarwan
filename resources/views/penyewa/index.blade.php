@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-50">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h3 class="text-2xl font-black text-gray-800 tracking-tight">Daftar Penyewa 👥</h3>
            <p class="text-gray-400 text-sm font-medium">Mengelola data penghuni kost Pak Budi.</p>
        </div>
        <button onclick="toggleModal('modal-add-penyewa')" class="bg-purple-500 hover:bg-purple-600 transition-all text-white px-6 py-3 rounded-2xl text-sm font-bold shadow-lg shadow-purple-100">
            + Registrasi Penyewa
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-separate border-spacing-y-3">
            <thead>
                <tr class="text-gray-400 text-xs uppercase tracking-widest px-4">
                    <th class="pb-4 pl-6 font-bold">Nama Lengkap</th>
                    <th class="pb-4 font-bold">Pekerjaan</th>
                    <th class="pb-4 font-bold">No. Telepon</th>
                    <th class="pb-4 font-bold">No. KTP</th>
                    <th class="pb-4 font-bold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($penyewas as $p)
                <tr class="bg-gray-50/50 hover:bg-white hover:shadow-md transition-all rounded-2xl">
                    <td class="py-4 pl-6 font-bold text-gray-800 rounded-l-2xl">{{ $p->nama_lengkap }}</td>
                    <td class="py-4 font-medium text-purple-600">{{ $p->pekerjaan }}</td>
                    <td class="py-4 font-medium text-gray-600">{{ $p->nomor_telepon }}</td>
                    <td class="py-4 font-mono text-xs text-gray-400">{{ $p->nomor_ktp }}</td>
                    <td class="py-4 text-center rounded-r-2xl px-4">
                        <div class="flex justify-center gap-2">
                            <button class="p-2 bg-blue-50 text-blue-500 rounded-xl hover:bg-blue-500 hover:text-white transition-all">📝</button>
                            <form action="{{ route('penyewa.destroy', $p->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 bg-pink-50 text-pink-500 rounded-xl hover:bg-pink-500 hover:text-white transition-all">🗑️</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-10 text-center text-gray-400 font-medium bg-gray-50 rounded-[2rem]">
                        Belum ada data penyewa terdaftar.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="modal-add-penyewa" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/40 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-lg rounded-[2.5rem] shadow-2xl p-10">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-black text-gray-800">Registrasi Baru</h2>
            <button onclick="toggleModal('modal-add-penyewa')" class="text-gray-400 hover:text-gray-600 text-2xl font-bold">&times;</button>
        </div>

        <form action="{{ route('penyewa.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1">
                    <label class="text-xs font-bold text-gray-400 uppercase ml-2">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" required class="w-full px-5 py-3 bg-gray-100 border-0 rounded-2xl outline-none focus:ring-2 focus:ring-purple-400">
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-bold text-gray-400 uppercase ml-2">Pekerjaan</label>
                    <input type="text" name="pekerjaan" required class="w-full px-5 py-3 bg-gray-100 border-0 rounded-2xl outline-none focus:ring-2 focus:ring-purple-400">
                </div>
            </div>
            <div class="space-y-1">
                <label class="text-xs font-bold text-gray-400 uppercase ml-2">Nomor KTP (Unique)</label>
                <input type="text" name="nomor_ktp" required class="w-full px-5 py-3 bg-gray-100 border-0 rounded-2xl outline-none focus:ring-2 focus:ring-purple-400">
            </div>
            <div class="space-y-1">
                <label class="text-xs font-bold text-gray-400 uppercase ml-2">Nomor Telepon/WA</label>
                <input type="text" name="nomor_telepon" required class="w-full px-5 py-3 bg-gray-100 border-0 rounded-2xl outline-none focus:ring-2 focus:ring-purple-400">
            </div>
            <div class="space-y-1">
                <label class="text-xs font-bold text-gray-400 uppercase ml-2">Alamat Asal</label>
                <textarea name="alamat_asal" rows="3" class="w-full px-5 py-3 bg-gray-100 border-0 rounded-2xl outline-none focus:ring-2 focus:ring-purple-400"></textarea>
            </div>
            <button type="submit" class="w-full py-4 bg-purple-500 text-white font-bold rounded-2xl shadow-lg shadow-purple-100 mt-4 hover:bg-purple-600 transition-all">Simpan Data Penyewa</button>
        </form>
    </div>
</div>

<script>
    function toggleModal(id) {
        document.getElementById(id).classList.toggle('hidden');
    }
</script>
@endsection