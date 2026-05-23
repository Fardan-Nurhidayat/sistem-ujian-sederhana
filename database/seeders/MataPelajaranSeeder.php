<?php

namespace Database\Seeders;

use App\Models\MataPelajaran;
use App\Models\User;
use Illuminate\Database\Seeder;

class MataPelajaranSeeder extends Seeder
{
    public function run(): void
    {
        $guru = User::where('email', 'teacher@gmail.com')->first();

        if (! $guru) {
            return;
        }

        $mataPelajarans = [
            [
                'nama' => 'Matematika',
                'kode' => 'MTK',
                'kkm' => 75,
            ],
            [
                'nama' => 'Bahasa Indonesia',
                'kode' => 'BIN',
                'kkm' => 70,
            ],
            [
                'nama' => 'Pemrograman Dasar',
                'kode' => 'PD',
                'kkm' => 80,
            ],
        ];

        foreach ($mataPelajarans as $mataPelajaran) {
            MataPelajaran::updateOrCreate(
                ['kode' => $mataPelajaran['kode']],
                [
                    'nama' => $mataPelajaran['nama'],
                    'kkm' => $mataPelajaran['kkm'],
                    'guru_id' => $guru->id,
                ]
            );
        }
    }
}
