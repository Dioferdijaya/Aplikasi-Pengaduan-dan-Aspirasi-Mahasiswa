<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Verifikasi Email</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
            height: 100vh;
        }

        .verify-container {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .verify-card {
            max-width: 500px;
            width: 100%;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .card-header {
            background-color: #4CD7BD;
            color: white;
            text-align: center;
            font-weight: bold;
            font-size: 1.5rem;
            padding: 15px;
        }

        .card-body {
            padding: 30px;
            background-color: white;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px 15px;
        }

        .form-label {
            font-weight: 600;
            color: #555;
        }

        .btn-verify {
            background-color: #4CD7BD;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: bold;
            width: 100%;
        }

        .btn-verify:hover {
            background-color: #3bc1a8;
        }

        .alert {
            border-radius: 10px;
        }

        .btn-link {
            color: #4CD7BD;
            text-decoration: none;
        }

        .btn-link:hover {
            color: #3bc1a8;
            text-decoration: underline;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="verify-container">
        <div class="verify-card">
            <div class="card-header">
                {{ __('Verifikasi Email') }}
            </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <p class="mb-4">Kami telah mengirimkan kode OTP ke alamat email Anda. Silakan periksa kotak masuk email dan masukkan kode OTP di bawah ini.</p>

                <form method="POST" action="{{ route('verification.verify') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">

                    <div class="form-group mb-4">
                        <label for="otp_code" class="form-label">{{ __('Kode OTP') }}</label>
                        <input id="otp_code" type="text" class="form-control @error('otp_code') is-invalid @enderror" name="otp_code" required autocomplete="off" autofocus>

                        @error('otp_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <button type="submit" class="btn btn-primary btn-verify">
                            {{ __('Verifikasi') }}
                        </button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <button type="submit" class="btn btn-link">
                            {{ __('Kirim ulang kode OTP') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
