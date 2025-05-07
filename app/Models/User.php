<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Kolom‐kolom yang boleh di‐mass assign
    protected $fillable = [
        'NPM',
        'password',
        'ma_lengkapna',
        'email',
        'no_telepon',
        'tanggal_registrasi',
        'role',
    ];

    // Sembunyikan ini waktu serialisasi (API / JSON)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casting kolom ke tipe PHP
    protected $casts = [
        'tanggal_registrasi' => 'datetime',
        'email_verified_at'   => 'datetime',
    ];

    /**
     * Relasi: satu user bisa mengirim banyak kritik/saran
     */
    public function kritikSarans()
    {
        return $this->hasMany(KritikSaran::class, 'user_id');
    }

    /**
     * Relasi: jika user adalah admin, bisa punya banyak tanggapan
     */
    public function tanggapans()
    {
        return $this->hasMany(Tanggapan::class, 'admin_id');
    }

    /**
     * Relasi banyak‐ke‐banyak ke roles
     */
    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'role_user',    // pivot table
            'user_id',
            'role_id'
        );
    }

    /**
     * Relasi satu‐ke‐satu ke profil mahasiswa (jika ada)
     */
    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'user_id');
    }

    /**
     * Relasi satu‐ke‐satu ke profil admin (jika ada)
     */
    public function adminProfile()
    {
        return $this->hasOne(Admin::class, 'user_id');
    }

    /**
     * Helper: cek apakah user punya role "admin"
     */
    public function isAdmin(): bool
    {
        return $this->roles->contains('nama_role', 'admin');
    }

    /**
     * Helper: cek apakah user punya role "user" (mahasiswa)
     */
    public function isUser(): bool
    {
        return $this->roles->contains('nama_role', 'user');
    }
}
