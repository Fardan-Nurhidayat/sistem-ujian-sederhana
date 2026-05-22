<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ujian extends Model
{
    protected $table = "ujians";
    protected $fillable = [
        'nama',
        'mata_pelajaran_id',
        'tanggal',
    ];

    public function mataPelajaran(): BelongsTo
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }

    public function peserta(): BelongsTo
    {
        return $this->belongsTo(PesertaUjian::class, 'peserta_ujian_id');
    }
}
