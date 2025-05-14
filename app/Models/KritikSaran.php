<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KritikSaran extends Model
{
    use HasFactory;

    protected $table = 'kritik_sarans';

    protected $fillable = [
        'user_id',
        'from',
        'judul',
        'isi_pesan',
        'tujuan',
        'tanggal_kirim',
        'status',
        'kategori',
        'lampiran'
    ];

    /**
     * Get the user that sent this kritik/saran
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the tanggapan for the kritik saran.
     */
    public function tanggapan()
    {
        return $this->hasOne(Tanggapan::class);
    }
}
