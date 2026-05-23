<?php

namespace Database\Seeders;

use App\Models\MataPelajaran;
use App\Models\Ujian;
use Illuminate\Database\Seeder;

class UjianSeeder extends Seeder
{
    public function run(): void
    {
        $mataPelajarans = MataPelajaran::orderBy('id')->get();

        $ujians = [
            [
                'nama' => 'Ujian Tengah Semester Matematika',
                'mata_pelajaran_kode' => 'MTK',
                'tanggal' => now()->addDay()->toDateString(),
            ],
            [
                'nama' => 'Ujian Bahasa Indonesia',
                'mata_pelajaran_kode' => 'BIN',
                'tanggal' => now()->toDateString(),
            ],
            [
                'nama' => 'Ujian Pemrograman Dasar',
                'mata_pelajaran_kode' => 'PD',
                'tanggal' => now()->subDay()->toDateString(),
            ],
        ];

        foreach ($ujians as $ujianData) {
            $mataPelajaran = $mataPelajarans->firstWhere('kode', $ujianData['mata_pelajaran_kode']);

            if (! $mataPelajaran) {
                continue;
            }

            Ujian::updateOrCreate(
                [
                    'nama' => $ujianData['nama'],
                    'mata_pelajaran_id' => $mataPelajaran->id,
                    'tanggal' => $ujianData['tanggal'],
                ],
                []
            );
        }
    }
}
