<?php

namespace Database\Seeders;

use App\Models\Kamar;
use App\Models\Penyewa;
use App\Models\KontrakSewa;
use App\Models\Pembayaran;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 15; $i++) {
            Kamar::create([
                'nomor_kamar' => 'A' . $i,
                'tipe' => $i <= 5 ? 'standard' : ($i <= 10 ? 'deluxe' : 'vip'),
                'harga_bulanan' => $i <= 5 ? 500000 : ($i <= 10 ? 900000 : 1500000),
                'fasilitas' => $i <= 5 ? 'Kasur, Lemari' : ($i <= 10 ? 'AC, Kasur, WiFi' : 'AC, TV, Water Heater, WiFi'),
                'status' => 'tersedia',
            ]);
        }


        $names = ['Karina', 'Lisa', 'Jennie', 'Jake', 'Jay'];
        $jobs = ['Mahasiswa', 'Karyawan', 'Karyawan', 'Mahasiswa', 'Karyawan'];
        
        $penyewaIds = [];
        foreach ($names as $key => $name) {
            $p = Penyewa::create([
                'nama_lengkap' => $name,
                'nomor_telepon' => '0812' . rand(10000000, 99999999),
                'nomor_ktp' => '3201' . rand(100000000000, 999999999999),
                'alamat_asal' => 'Jakarta/Seoul',
                'pekerjaan' => $jobs[$key],
            ]);
            $penyewaIds[] = $p->id;
        }

        $kamarIds = [11, 1, 6]; 
        $hargas = [1500000, 500000, 900000];

        foreach ($kamarIds as $key => $kId) {
            $kontrak = KontrakSewa::create([
                'penyewa_id' => $penyewaIds[$key],
                'kamar_id' => $kId,
                'tanggal_mulai' => '2025-01-01',
                'tanggal_selesai' => '2025-12-31',
                'harga_bulanan' => $hargas[$key],
                'status' => 'aktif',
            ]);

            Kamar::find($kId)->update(['status' => 'terisi']);


            Pembayaran::create([
                'kontrak_sewa_id' => $kontrak->id,
                'bulan' => 1,
                'tahun' => 2025,
                'jumlah_bayar' => $key == 2 ? 0 : $hargas[$key],
                'tanggal_bayar' => $key == 2 ? null : now(),
                'status' => $key == 2 ? 'tertunggak' : 'lunas',
                'keterangan' => $key == 2 ? 'Belum bayar bulan Januari' : 'Lunas tepat waktu',
            ]);
        }
    }
}