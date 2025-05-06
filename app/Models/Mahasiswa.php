<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    // Tabelnya bernama "mahasiswa" (bukan plural)
    protected $table = 'mahasiswa';

    // Primary key: Laravel akan pakai "id" secara default,
    // tapi migrasi kita gunakan $table->id() ⇒ nama kolom "id"
    // Jadi tidak perlu override primaryKey.

    protected $fillable = [
        'user_id',
        'npm',
        'jurusan',
        'fakultas',
        'angkatan',
    ];

    /**
     * Relasi one‑to‑one ke User (profil pemilik akun)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
