<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Register</title>

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

        .register-container {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-card {
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

        .btn-register {
            background-color: #4CD7BD;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: bold;
            width: 100%;
            margin-top: 10px;
        }

        .btn-register:hover {
            background-color: #3bc1a8;
        }

        .card-footer {
            background-color: #f8f9fa;
            text-align: center;
            padding: 15px;
            border-top: 1px solid #eee;
        }

        .card-footer a {
            color: #4CD7BD;
            font-weight: 600;
            text-decoration: none;
        }

        .card-footer a:hover {
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
    <div class="register-container">
        <div class="register-card">
            <div class="card-header">
                {{ __('Register') }}
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="username" class="form-label">{{ __('Username') }}</label>
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama_lengkap" class="form-label">{{ __('Nama Lengkap') }}</label>
                        <input id="nama_lengkap" type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required autocomplete="name">
                        @error('nama_lengkap')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">{{ __('Alamat Email') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="form-label">{{ __('Konfirmasi Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="form-group">
                        <label for="no_telepon" class="form-label">{{ __('Nomor Telepon') }}</label>
                        <input id="no_telepon" type="text" class="form-control @error('no_telepon') is-invalid @enderror" name="no_telepon" value="{{ old('no_telepon') }}" autocomplete="tel">
                        @error('no_telepon')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary btn-register">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>

            <div class="card-footer">
                <p class="mb-0">Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
