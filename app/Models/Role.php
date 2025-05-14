<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Nama tabel sudah "roles", sesuai konvensi Laravel
    // protected $table = 'roles';

    // Kolom yang boleh mass‑assign
    protected $fillable = [
        'nama_role',
    ];

    /**
     * Relasi many‑to‑many ke User
     * Pivot table: role_user (user_id, role_id)
     */
    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'role_user',   // pivot table
            'role_id',     // FK pada pivot yang mengacu ke roles.id
            'user_id'      // FK pada pivot yang mengacu ke users.id
        );
    }
}
