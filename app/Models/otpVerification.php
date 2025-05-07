<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtpVerification extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'otp_code', 'expires_at', 'is_verified'];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_verified' => 'boolean',
    ];
}
