<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ujian extends Model
{
    protected $table = "ujians";
    protected $fillable = [
        'nama',
        'mata_pelajaran_id',
        'tanggal',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function getStatusAttribute(): string
    {
        $currentDate = now()->startOfDay();
        $examDate = $this->tanggal->startOfDay();

        if ($currentDate->lt($examDate)) {
            return 'Belum Dimulai';
        } elseif ($currentDate->eq($examDate)) {
            return 'Sedang Berlangsung';
        } else {
            return 'Sudah Selesai';
        }
    }

    public function mataPelajaran(): BelongsTo
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }

    public function peserta(): HasMany
    {
        return $this->hasMany(PesertaUjian::class, 'ujian_id');
    }
}
