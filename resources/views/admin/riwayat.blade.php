
<?php $adminInitials = strtoupper(substr(Auth::user()->nama_lengkap ?? 'AD', 0, 2)); ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Riwayat Kritik dan Saran</title>
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

        .message-box {
            background: #f6f6f6;
            padding: 12px;
            border-radius: 10px;
            margin: 8px 0;
            border-left: 4px solid #278a76;
        }

        .reply-box {
            background: #e9f9f4;
            padding: 12px;
            border-radius: 10px;
            margin: 8px 0 16px 20px;
            border-left: 4px solid #4caf50;
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
            margin-right: 8px;
        }

        .date {
            font-size: 12px;
            color: gray;
            margin-top: 6px;
        }

        .message-actions {
            display: flex;
            gap: 8px;
            margin-top: 8px;
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

        .message-attachment img {
            max-width: 100%;
            max-height: 200px;
            border-radius: 8px;
            margin: 8px 0;
        }

        .complete-btn {
            background: #4caf50;
            color: white;
            padding: 6px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="welcome">
                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($adminInitials); ?>&background=0D8ABC&color=fff&size=100" alt="Avatar" class="avatar">
                <h2>Riwayat Kritik & Saran</h2>
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
            <a href="{{ route('admin.dashboard') }}"><button>Beranda</button></a>
            <a href="{{ route('admin.riwayat') }}"><button class="active">Riwayat</button></a>
            <a href="#"><button>Pengaturan</button></a>
        </div>

        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 16px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="message-list">
            @forelse($pesans as $pesan)
                <div class="message-box">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <p><strong>{{ $pesan->user->nama_lengkap ?? 'Anonymous' }}</strong></p>
                        <span class="status-badge status-{{ $pesan->status }}">{{ ucfirst($pesan->status) }}</span>
                    </div>

                    @if($pesan->lampiran)
                        <div class="message-attachment">
                            <img src="{{ asset('storage/' . $pesan->lampiran) }}" alt="Lampiran" />
                        </div>
                    @endif

                    <p><strong>Judul:</strong> {{ $pesan->judul ?? 'Tidak ada judul' }}</p>
                    <p><strong>Kategori:</strong> {{ ucfirst($pesan->kategori ?? 'Umum') }}</p>
                    <p><strong>Pesan:</strong></p>
                    <p>{{ Str::limit($pesan->isi_pesan, 100) ?? 'Pesan tidak tersedia.' }}</p>
                    <p class="date">{{ $pesan->created_at ? $pesan->created_at->format('d F Y H:i') : 'Tanggal tidak tersedia' }}</p>

                    @if($pesan->tanggapan)
                        <div class="reply-box">
                            <p><strong>Tanggapan Admin:</strong></p>
                            <p>{{ $pesan->tanggapan->isi_tanggapan }}</p>
                            <p class="date">{{ $pesan->tanggapan->created_at ? $pesan->tanggapan->created_at->format('d F Y H:i') : 'Tanggal tidak tersedia' }}</p>
                        </div>
                    @endif

                    <div class="message-actions">
                        @if($pesan->status == 'baru')
                            <a href="{{ route('admin.pesan.balas', $pesan->id) }}" class="action-btn">
                                <i class="fas fa-reply"></i> Balas
                            </a>
                        @elseif($pesan->status == 'proses')
                            <form method="POST" action="{{ route('admin.pesan.selesai', $pesan->id) }}" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="complete-btn">
                                    <i class="fas fa-check"></i> Tandai Selesai
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="message-box">
                    <p>Tidak ada kritik atau saran.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="pagination">
            {{ $pesans->links() }}
        </div>
    </div>
</body>

</html>
