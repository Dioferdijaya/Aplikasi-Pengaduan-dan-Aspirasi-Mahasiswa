<?php

namespace App\Services;

use App\Models\OtpVerification;
use App\Mail\OtpVerification as OtpMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class OtpService
{
    /**
     * Validasi apakah email memiliki domain yang diizinkan
     *
     * @param string $email
     * @return bool
     */
    public function isValidEmailDomain($email)
    {
        $domain = explode('@', $email)[1] ?? '';
        return in_array($domain, ['mhs.usk.ac.id', 'usk.ac.id']);
    }
    // Generate dan kirim OTP
    public function sendOtp(string $email)
    {
        // Validasi domain email terlebih dahulu
        if (!$this->isValidEmailDomain($email)) {
            return false;
        }
        // Buat kode OTP acak 6 digit
        $otpCode = sprintf("%06d", mt_rand(1, 999999));

        // Tetapkan waktu kedaluwarsa (15 menit dari sekarang)
        $expiresAt = Carbon::now()->addMinutes(15);

        // Hapus OTP lama untuk email ini jika ada
        OtpVerification::where('email', $email)->delete();

        // Simpan OTP baru ke database
        $verification = OtpVerification::create([
            'email' => $email,
            'otp_code' => $otpCode,
            'expires_at' => $expiresAt,
        ]);

        // Kirim email OTP
        Mail::to($email)->send(new OtpMail($otpCode, $expiresAt));

        return true;
    }

    // Verifikasi OTP
    public function verifyOtp(string $email, string $otpCode)
    {
        $verification = OtpVerification::where('email', $email)
            ->where('otp_code', $otpCode)
            ->where('expires_at', '>', Carbon::now())
            ->where('is_verified', false)
            ->first();

        if (!$verification) {
            return false;
        }

        // Tandai sebagai sudah diverifikasi
        $verification->update(['is_verified' => true]);

        return true;
    }
}
