
<?php $adminInitials = strtoupper(substr(Auth::user()->nama_lengkap ?? 'AD', 0, 2)); ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Balas Kritik dan Saran</title>
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
            margin-bottom: 16px;
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

        .back-btn {
            background: #278a76;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 16px;
        }

        .message-box {
            background: #f6f6f6;
            padding: 12px;
            border-radius: 10px;
            margin: 8px 0;
            border-left: 4px solid #278a76;
        }

        .form-section {
            margin-bottom: 16px;
        }

        .form-section label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #278a76;
        }

        .form-section textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: inherit;
            font-size: 14px;
            min-height: 120px;
            resize: vertical;
        }

        .submit-btn {
            background: #278a76;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
        }

        .submit-btn:hover {
            background: #1f6b5e;
        }

        .date {
            font-size: 12px;
            color: gray;
            margin-top: 6px;
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

        .message-attachment img {
            max-width: 100%;
            max-height: 200px;
            border-radius: 8px;
            margin: 8px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="welcome">
                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($adminInitials); ?>&background=0D8ABC&color=fff&size=100" alt="Avatar" class="avatar">
                <h2>Balas Kritik & Saran</h2>
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

        <a href="{{ route('admin.dashboard') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>

        <!-- Tampilkan pesan asli -->
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
            <p>{{ $pesan->isi_pesan ?? 'Pesan tidak tersedia.' }}</p>
            <p class="date">{{ $pesan->created_at ? $pesan->created_at->format('d F Y H:i') : 'Tanggal tidak tersedia' }}</p>
        </div>

        <!-- Form untuk membalas -->
        <form method="POST" action="{{ route('admin.storeBalas', $pesan->id) }}">
            @csrf
            <div class="form-section">
                <label for="tanggapan">Tanggapan:</label>
                <textarea name="tanggapan" id="tanggapan" placeholder="Tulis tanggapan Anda di sini..." required></textarea>
            </div>

            <button type="submit" class="submit-btn">
                <i class="fas fa-paper-plane"></i> Kirim Tanggapan
            </button>
        </form>
    </div>
</body>

</html>
