<?php

namespace App\Enums;

enum StatusUjianSiswa: string
{
    case LULUS = 'lulus';
    case TIDAK_LULUS = 'tidak_lulus';
    case BelumDinilai = 'belum_dinilai';
    public function label(): string
    {
        return match ($this) {
            self::LULUS => 'Lulus',
            self::TIDAK_LULUS => 'Tidak Lulus',
            self::BelumDinilai => 'Belum Dinilai',
        };
    }
}
