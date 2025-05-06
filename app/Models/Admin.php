<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    // Tabelnya "admins"
    protected $table = 'admins';

    protected $fillable = [
        'user_id',
        'jabatan',
        'departemen',
    ];

    /**
     * Relasi one‑to‑one ke User (akun admin)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
