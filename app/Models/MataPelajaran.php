<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MataPelajaran extends Model
{
    protected $table = "mata_pelajarans";
    protected $fillable = [
        'nama',
        'kode',
        'kkm',
        'guru_id'
    ];


    public function guru(): BelongsTo
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function ujian(): HasMany
    {
        return $this->hasMany(Ujian::class, 'mata_pelajaran_id');
    }
}
