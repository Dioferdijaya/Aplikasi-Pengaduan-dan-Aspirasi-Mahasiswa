<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
        }

        .header-container {
            background-color: #fff;
            padding: 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            max-width: 100%;
        }

        .app-header {
            background-color: #4CD7BD; /* Hijau tosca sesuai gambar */
            color: white;
            border-radius: 10px;
            padding: 15px;
            margin: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .profile-section {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile-icon {
            width: 40px;
            height: 40px;
            background-color: #cceae4;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-icon i {
            color: #333;
            font-size: 22px;
        }

        .greeting {
            font-weight: bold;
            font-size: 18px;
        }

        .notification-icon {
            position: relative;
        }

        .notification-icon i {
            font-size: 20px;
            color: #fff;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #FF6B6B;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-tabs-container {
            padding: 0 15px;
            margin-bottom: 15px;
        }

        .custom-nav-tabs {
            display: flex;
            justify-content: space-between;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .custom-nav-tabs li {
            flex: 1;
            text-align: center;
        }

        .custom-nav-tabs a {
            display: block;
            padding: 10px;
            background-color: #e9ecef;
            color: #495057;
            text-decoration: none;
            border-radius: 20px;
            font-weight: 600;
            margin: 0 5px;
            transition: all 0.3s ease;
        }

        .custom-nav-tabs a:hover,
        .custom-nav-tabs a.active {
            background-color: #4CD7BD;
            color: white;
        }

        .content-container {
            padding: 0 15px 20px;
        }
    </style>
</head>
<body>
    <div id="app">
        <div class="container header-container">
            <div class="app-header">
                <div class="profile-section">
                    <div class="profile-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="greeting">
                        Hi, {{ Auth::user() ? Auth::user()->nama_lengkap : 'Ahmad' }} !!
                    </div>
                </div>
                <div class="notification-icon">
                    <i class="fas fa-envelope"></i>
                    <span class="notification-badge">1</span>
                </div>
            </div>

            <div class="nav-tabs-container">
                <ul class="custom-nav-tabs">
                    <li><a href="{{ route('user.dashboard') }}" class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">Beranda</a></li>
                    <li><a href="{{ route('messages.index') ?? '#' }}" class="{{ request()->routeIs('messages.index') ? 'active' : '' }}">Pesan</a></li>
                    <li><a href="{{ route('history.index') ?? '#' }}" class="{{ request()->routeIs('history.index') ? 'active' : '' }}">Riwayat</a></li>
                </ul>
            </div>
        </div>

        <main class="container content-container">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
