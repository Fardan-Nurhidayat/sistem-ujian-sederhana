<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\StatusUjianSiswa;

class PesertaUjian extends Model
{
    protected $table = "peserta_ujians";
    protected $fillable = [
        'siswa_id',
        'ujian_id',
        'nilai'
    ];

    public function getStatusAttribute()
    {
        if ($this->nilai === null) {
            return StatusUjianSiswa::BelumDinilai;
        } elseif ($this->nilai >= $this->ujian->mataPelajaran->kkm) {
            return StatusUjianSiswa::LULUS;
        } else {
            return StatusUjianSiswa::TIDAK_LULUS;
        }
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function ujian()
    {
        return $this->belongsTo(Ujian::class, 'ujian_id');
    }
}
