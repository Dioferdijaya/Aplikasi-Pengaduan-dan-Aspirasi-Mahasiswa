<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OtpVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $otpCode;
    public $expiresAt;

    public function __construct($otpCode, $expiresAt)
    {
        $this->otpCode = $otpCode;
        $this->expiresAt = $expiresAt;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Kode Verifikasi OTP',
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.otp-verification',
        );
    }
}
