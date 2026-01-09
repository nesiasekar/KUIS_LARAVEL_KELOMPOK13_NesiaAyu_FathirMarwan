@extends('layouts.app')

@section('content')
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-8 space-y-8">
        <div class="grid grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-50 flex items-center gap-4">
                <div class="w-12 h-12 bg-pink-50 rounded-2xl flex items-center justify-center text-xl">🏠</div>
                <div>
                    <p class="text-gray-400 text-sm font-medium">Total Kamar</p>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $total_kamar }}</h2>
                </div>
            </div>
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-50 flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-xl">📅</div>
                <div>
                    <p class="text-gray-400 text-sm font-medium">Tersedia</p>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $kamar_tersedia }}</h2>
                </div>
            </div>
            <div class="bg-purple-500 p-6 rounded-[2rem] shadow-xl shadow-purple-200 flex items-center gap-4 text-white relative overflow-hidden">
                <div class="relative z-10">
                    <p class="opacity-80 text-sm font-medium">Kamar Terisi</p>
                    <h2 class="text-3xl font-extrabold">{{ $kamar_terisi }}</h2>
                </div>
                <div class="ml-auto bg-white/20 px-3 py-1 rounded-full text-xs font-bold">
                    {{ $total_kamar > 0 ? round(($kamar_terisi / $total_kamar) * 100) : 0 }}%
                </div>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-50">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-800 tracking-tight">Status Kamar Terkini</h3>
                <button onclick="toggleModal('modal-add-kamar')" class="bg-purple-500 hover:bg-purple-600 transition-all text-white px-6 py-2 rounded-xl text-sm font-bold shadow-md">+ Add Room</button>
            </div>
            <table class="w-full text-left">
                <thead>
                    <tr class="text-gray-400 text-xs uppercase tracking-widest border-b border-gray-50">
                        <th class="pb-4 font-bold">No Kamar</th>
                        <th class="pb-4 font-bold">Tipe</th>
                        <th class="pb-4 font-bold">Harga</th>
                        <th class="pb-4 font-bold">Status</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-600">
                    @forelse($recent_kamars as $kamar)
                    <tr class="border-b border-gray-50/50 hover:bg-gray-50 transition-colors">
                        <td class="py-4 font-bold text-gray-800">{{ $kamar->nomor_kamar }}</td>
                        <td class="py-4 font-medium capitalize">{{ $kamar->tipe }}</td>
                        <td class="py-4 font-medium">Rp {{ number_format($kamar->harga_bulanan, 0, ',', '.') }}</td>
                        <td class="py-4">
                            <span class="{{ $kamar->status == 'tersedia' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }} px-3 py-1 rounded-full text-[10px] font-bold uppercase">
                                {{ $kamar->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="py-8 text-center text-gray-400">Data kamar kosong.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="space-y-4">
            <h3 class="text-xl font-bold text-gray-800 tracking-tight">Daftar Kamar</h3>
            <div class="grid grid-cols-4 gap-4">
                @foreach(\App\Models\Kamar::all() as $k)
                <div class="p-4 rounded-3xl border {{ $k->status == 'tersedia' ? 'bg-white border-gray-100' : 'bg-gray-50 border-transparent opacity-60' }} transition-all hover:shadow-md">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-lg font-black {{ $k->status == 'tersedia' ? 'text-purple-600' : 'text-gray-400' }}">{{ $k->nomor_kamar }}</span>
                        <div class="w-2 h-2 rounded-full {{ $k->status == 'tersedia' ? 'bg-green-500 shadow-[0_0_8px_rgba(34,197,94,0.6)]' : 'bg-red-500' }}"></div>
                    </div>
                    <p class="text-[10px] uppercase font-bold text-gray-400 tracking-widest">{{ $k->tipe }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-span-4 space-y-6">
        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-50">
            <h3 class="text-lg font-bold text-gray-800 mb-6">Today's Revenue</h3>
            <div class="bg-gray-50 p-6 rounded-3xl text-center mb-6">
                <p class="text-sm text-gray-400 font-medium mb-1">Total Pendapatan</p>
                <p class="text-3xl font-black text-gray-800">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</p>
            </div>
            <button onclick="toggleModal('modal-add-kontrak')" class="w-full py-4 bg-gray-900 text-white rounded-2xl font-bold hover:bg-black transition-all">Buat Kontrak Baru ✍️</button>
        </div>

        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-50">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Occupancy Rate</h3>
            <div class="h-4 bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full bg-purple-500" style="width: {{ $total_kamar > 0 ? ($kamar_terisi/$total_kamar)*100 : 0 }}%"></div>
            </div>
            <p class="text-xs text-gray-400 mt-2 font-medium">Rasio okupasi kamar saat ini.</p>
        </div>
    </div>
</div>

<div id="modal-add-kamar" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl p-8 transform transition-all">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-black text-gray-800">Kamar Baru</h2>
            <button onclick="toggleModal('modal-add-kamar')" class="text-gray-400 hover:text-gray-600 text-2xl font-bold">&times;</button>
        </div>
        <form action="{{ route('kamar.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Nomor Kamar</label>
                <input type="text" name="nomor_kamar" required placeholder="Contoh: A1" class="w-full px-5 py-3 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-purple-500 outline-none @error('nomor_kamar') border-red-500 @enderror">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Tipe</label>
                    <select name="tipe" class="w-full px-5 py-3 bg-gray-50 border-0 rounded-2xl outline-none">
                        <option value="standard">Standard</option>
                        <option value="deluxe">Deluxe</option>
                        <option value="vip">VIP</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Harga</label>
                    <input type="number" name="harga_bulanan" required placeholder="1500000" class="w-full px-5 py-3 bg-gray-50 border-0 rounded-2xl outline-none">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Fasilitas</label>
                <textarea name="fasilitas" rows="2" class="w-full px-5 py-3 bg-gray-50 border-0 rounded-2xl outline-none" placeholder="AC, WiFi..."></textarea>
            </div>
            <input type="hidden" name="status" value="tersedia">
            <button type="submit" class="w-full py-4 bg-purple-500 text-white font-bold rounded-2xl shadow-lg shadow-purple-100 mt-4">Simpan Kamar</button>
        </form>
    </div>
</div>

<script>
    function toggleModal(id) {
        document.getElementById(id).classList.toggle('hidden');
    }
</script>
@endsection