<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    use HasFactory;

    protected $table = 'tanggapan';

    protected $fillable = [
        'kritik_saran_id',
        'admin_id',
        'isi_tanggapan',
        'tanggal',
    ];

    /**
     * Relasi: tanggapan milik satu kritik/saran
     */
    public function kritikSaran()
    {
        return $this->belongsTo(KritikSaran::class, 'kritik_saran_id');
    }

    /**
     * Relasi: tanggapan dibuat oleh satu admin (user dengan role admin)
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
