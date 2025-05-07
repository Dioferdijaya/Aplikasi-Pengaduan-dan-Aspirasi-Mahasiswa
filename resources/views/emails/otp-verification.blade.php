{{-- resources/views/emails/otp-verification.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kode Verifikasi OTP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .header {
            text-align: center;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        .otp-code {
            font-size: 24px;
            letter-spacing: 5px;
            background-color: #f5f5f5;
            padding: 10px;
            text-align: center;
            margin: 20px 0;
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Kode Verifikasi OTP</h2>
        </div>

        <p>Halo!</p>

        <p>Terima kasih telah mendaftar di Sistem Kritik & Saran. Untuk memverifikasi alamat email Anda, silakan masukkan kode OTP berikut pada halaman verifikasi:</p>

        <div class="otp-code">{{ $otpCode }}</div>

        <p>Kode OTP ini akan kedaluwarsa pada: <strong>{{ $expiresAt->format('d M Y H:i') }}</strong></p>

        <p>Jika Anda tidak meminta kode ini, abaikan email ini.</p>

        <div class="footer">
            <p>Email ini dikirim secara otomatis. Mohon tidak membalas email ini.</p>
            <p>&copy; {{ date('Y') }} Sistem Kritik & Saran. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
