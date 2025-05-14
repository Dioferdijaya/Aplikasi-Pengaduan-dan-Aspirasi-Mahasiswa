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
        'judul',
        'pesan',
        'lampiran',
        'status',
        'tujuan'
    ];

    /**
     * Get the user that sent this kritik/saran
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the tanggapan for this kritik/saran
     */
    public function tanggapan()
    {
        return $this->hasOne(Tanggapan::class);
    }
}
