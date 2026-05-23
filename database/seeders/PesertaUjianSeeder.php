<?php

namespace Database\Seeders;

use App\Models\PesertaUjian;
use App\Models\Siswa;
use App\Models\Ujian;
use Illuminate\Database\Seeder;

class PesertaUjianSeeder extends Seeder
{
    public function run(): void
    {
        $siswa = Siswa::first();

        if (! $siswa) {
            return;
        }

        $ujians = Ujian::orderBy('id')->get();

        foreach ($ujians as $index => $ujian) {
            PesertaUjian::updateOrCreate(
                [
                    'siswa_id' => $siswa->id,
                    'ujian_id' => $ujian->id,
                ],
                [
                    'nilai' => $index === 2 ? 78 : null,
                ]
            );
        }
    }
}
