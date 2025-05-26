<?php $adminInitials = strtoupper(substr(Auth::user()->nama_lengkap ?? 'AD', 0, 2)); ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: auto;
            background: white;
            padding: 16px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #278a76;
            padding: 10px 16px;
            border-radius: 12px;
            color: white;
        }

        .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .welcome {
            display: flex;
            align-items: center;
        }

        .notif {
            position: relative;
        }

        .badge {
            background: red;
            color: white;
            font-size: 10px;
            padding: 2px 5px;
            border-radius: 50%;
            position: absolute;
            top: -5px;
            right: -5px;
        }

        .nav {
            display: flex;
            justify-content: space-around;
            margin: 16px 0;
        }

        .nav button {
            padding: 8px 12px;
            border: none;
            border-radius: 20px;
            background: #e0f5ef;
            cursor: pointer;
        }

        .nav .active {
            background: #278a76;
            color: white;
        }

        .profile-box {
            display: flex;
            align-items: center;
            background: #e9f9f4;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 16px;
        }

        .profile-box img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .section-title {
            font-weight: bold;
            margin: 12px 0 8px;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            margin-bottom: 16px;
        }

        .stat-box {
            background: #e9f9f4;
            padding: 12px;
            border-radius: 10px;
            text-align: center;
        }

        .stat-box .number {
            font-size: 24px;
            font-weight: bold;
            color: #278a76;
        }

        .stat-box .label {
            font-size: 12px;
            color: #666;
        }

        .message-list {
            margin-top: 16px;
        }

        .message-box {
            background: #f6f6f6;
            padding: 12px;
            border-radius: 10px;
            margin: 8px 0;
            border-left: 4px solid #278a76;
        }

        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
            color: white;
        }

        .status-baru {
            background-color: #ff9800;
        }

        .status-proses {
            background-color: #2196f3;
        }

        .status-selesai {
            background-color: #4caf50;
        }

        .action-btn {
            background: #278a76;
            color: white;
            padding: 6px 10px;
            border: none;
            border-radius: 5px;
            margin-top: 8px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
        }

        .date {
            font-size: 12px;
            color: gray;
            margin-top: 6px;
        }

        .datauser {
            font-size: 12px;
        }

        .message-actions {
            display: flex;
            gap: 8px;
            margin-top: 8px;
        }

        .suggestion-box {
            background: #bfffe2;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 14px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            color: #278a76;
            font-size: 14px;
            margin-bottom: 16px;
        }

        .suggestion-box i {
            font-size: 16px;
        }

        .suggestion-link {
            flex: 1;
            margin: 0 10px;
            text-decoration: none;
            color: #278a76;
            font-weight: bold;
        }

        .icon {
            width: 40px;
            height: 40px;
            vertical-align: middle;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 16px;
        }

        .pagination a {
            background: #e0f5ef;
            color: #278a76;
            padding: 5px 10px;
            margin: 0 3px;
            border-radius: 5px;
            text-decoration: none;
        }

        .pagination .active {
            background: #278a76;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="welcome">
                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($adminInitials); ?>&background=0D8ABC&color=fff&size=100" alt="Avatar" class="avatar">
                <h2>Hi, {{ Auth::user()->nama_lengkap ?? 'Admin' }} !!</h2>
            </div>
            <div>
                <a href="{{ route('logout') }}" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="logout-icon">
                        <i class="fas fa-right-from-bracket"></i>
                    </div>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>

        <div class="nav">
            <a href="{{ route('admin.dashboard') }}"><button class="active">Beranda</button></a>
            <a href="{{ route('admin.riwayat') }}"><button>Riwayat</button></a>
            <a href="#"><button>Pengaturan</button></a>
        </div>

        <div class="profile-box">
            <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($adminInitials); ?>&background=0D8ABC&color=fff&size=100" alt="Avatar" style="border: 2px solid black; border-radius: 50%;">
            <div class="profile-text">
                <strong>{{ Auth::user()->nama_lengkap ?? 'Admin' }}</strong>
                <p class="datauser">
                    Admin {{ Auth::user()->role ?? 'Fakultas' }} | {{ Auth::user()->email ?? 'admin@example.com' }}
                </p>
            </div>
        </div>

        <div class="section-title">Statistik Kritik dan Saran</div>

        <div class="stats-container">
            <div class="stat-box">
                <div class="number">{{ $total }}</div>
                <div class="label">Total</div>
            </div>
            <div class="stat-box">
                <div class="number">{{ $baru }}</div>
                <div class="label">Baru</div>
            </div>
            <div class="stat-box">
                <div class="number">{{ $proses }}</div>
                <div class="label">Proses</div>
            </div>
            <div class="stat-box">
                <div class="number">{{ $selesai }}</div>
                <div class="label">Selesai</div>
            </div>
        </div>

        <div class="suggestion-box">
            <a href="{{ route('admin.riwayat') }}" class="suggestion-link">
                <img src="/image.png" alt="Ikon Kritik Saran" class="icon"> Lihat Semua Kritik dan Saran
            </a>
            <i class="fas fa-chevron-right"></i>
        </div>

        <div class="section-title">Pesan Terbaru</div>

 <div class="message-list">
            @php
                $pesanBaru = \App\Models\KritikSaran::where('status', 'baru')
                    ->with('user')
                    ->latest()
                    ->take(5)
                    ->get();
            @endphp

            @forelse($pesanBaru as $pesan)
                <div class="message-box">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <p><strong>{{ $pesan->user->nama_lengkap ?? 'Anonymous' }}</strong></p>
                        <span class="status-badge status-{{ $pesan->status }}">{{ ucfirst($pesan->status) }}</span>
                    </div>

                    @if($pesan->lampiran)
                        <div class="message-attachment">
                            <img src="{{ asset('storage/' . $pesan->lampiran) }}" alt="Lampiran" style="max-width: 100%; max-height: 200px; margin-bottom: 10px; border-radius: 8px;">
                        </div>
                    @endif

                    <p><strong>Judul:</strong> {{ $pesan->judul ?? 'Tidak ada judul' }}</p>
                    <p style="margin-bottom: 5px;"><strong>Pesan:</strong></p>
                    <p style="margin-top: 0;">{{ Str::limit($pesan->isi_pesan, 100) ?? 'Pesan tidak tersedia.' }}</p>
                    <p class="date">{{ $pesan->created_at ? $pesan->created_at->format('d F Y H:i') : 'Tanggal tidak tersedia' }}</p>

                    <div class="message-actions">
                        <a href="{{ route('admin.pesan.balas', $pesan->id) }}" class="action-btn">
                            <i class="fas fa-reply"></i> Balas
                        </a>
                        <a href="{{ route('admin.riwayat') }}" class="action-btn">
                            <i class="fas fa-eye"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="message-box">
                    <p>Tidak ada pesan baru.</p>
                </div>
            @endforelse
        </div>
    </div>
</body>

</html>
