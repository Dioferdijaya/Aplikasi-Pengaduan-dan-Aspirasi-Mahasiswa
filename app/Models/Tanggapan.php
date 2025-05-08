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
        'lampiran'
    ];

    /**
     * Get the kritik/saran this tanggapan belongs to
     */
    public function kritikSaran()
    {
        return $this->belongsTo(KritikSaran::class, 'kritik_saran_id');
    }

    /**
     * Get the admin who created this tanggapan
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
