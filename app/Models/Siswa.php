<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Siswa extends Model
{
    protected $table = "siswas";
    protected $fillable = [
        'nis',
        'alamat',
        'kelas',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pesertaUjian()
    {
        return $this->hasMany(PesertaUjian::class, 'siswa_id');
    }
}
