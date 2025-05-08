<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KritikSaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'judul',
        'pesan',
        'tujuan',
        'tanggal_kirim',
        'status',
        'prioritas',
        'kategori_id',
        'lampiran'
    ];

    /**
     * Get the user that owns the kritik saran.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the kategori that owns the kritik saran.
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    /**
     * Get the tanggapan for the kritik saran.
     */
    public function tanggapan(): HasMany
    {
        return $this->hasMany(Tanggapan::class);
    }
}
