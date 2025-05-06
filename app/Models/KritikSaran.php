<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KritikSaran extends Model
{
    use HasFactory;

    // Table name (opsional, akan otomatis 'kritik_sarans')
    // protected $table = 'kritik_sarans';

    // Field yang boleh di‐mass assign
    protected $fillable = [
        'user_id',
        'judul',
        'pesan',
        'lampiran',
        'status',
    ];

    /**
     * Relasi: satu kritik/saran dimiliki oleh satu user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: satu kritik/saran bisa punya banyak tanggapan
     */
    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class, 'kritik_saran_id');
    }
}
