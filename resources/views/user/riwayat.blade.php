<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Riwayat Pesan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 400px;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            height: 100vh;
            margin: auto;
            padding: 20px;
        }

        .header {
            background-color: #41bfb3;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 8px;
            color: white;
            font-weight: bold;
        }

        .profile img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }

        .notif {
            position: relative;
        }

        .notif img {
            width: 30px;
        }

        .dot {
            position: absolute;
            top: 0;
            right: 0;
            width: 10px;
            height: 10px;
            background: red;
            border-radius: 50%;
            border: 2px solid white;
        }

        .menu {
            border: 2px solid #41bfb3;
            border-radius: 20px;
            padding: 5px;
            display: flex;
            justify-content: space-around;
            margin-bottom: 30px;
        }

        .menu button {
            padding: 6px 25px;
            border: 2px solid #41bfb3;
            background: white;
            border-radius: 20px;
            cursor: pointer;
            font-weight: bold;
        }

        .menu .active {
            background: #41bfb3;
            color: white;
        }

        .riwayat-section {
            padding: 10px;
            height: calc(100vh - 180px);
            overflow-y: auto;
        }

        .riwayat-section h3 {
            margin-bottom: 15px;
            color: #333;
        }

        .kategori-filter {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 8px 16px;
            border: 2px solid #41bfb3;
            background: white;
            border-radius: 20px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .filter-btn.active {
            background: #41bfb3;
            color: white;
        }

        .pesan-item {
            border: 2px solid #41bfb3;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .pesan-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #e0e0e0;
            flex-wrap: wrap;
        }

        .pesan-judul {
            font-weight: bold;
            font-size: 1.1em;
            margin-right: 10px;
        }

        .pesan-kategori {
            font-weight: bold;
            color: #41bfb3;
            font-size: 0.9em;
            padding: 2px 8px;
            border: 1px solid #41bfb3;
            border-radius: 12px;
            margin-right: auto;
        }

        .pesan-tanggal {
            font-size: 0.8em;
            color: #888;
        }

        .pesan-status {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 0.8em;
            font-weight: bold;
            margin-top: 5px;
        }

        .status-baru {
            background-color: #ffecb3;
            color: #ff9800;
        }

        .status-proses {
            background-color: #e3f2fd;
            color: #2196f3;
        }

        .status-selesai {
            background-color: #e8f5e9;
            color: #4caf50;
        }

        .pesan-isi {
            margin-bottom: 15px;
            line-height: 1.5;
        }

        .pesan-tanggapan {
            background-color: #f5f5f5;
            border-radius: 8px;
            padding: 10px;
            margin-top: 10px;
        }

        .tanggapan-header {
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .tanggapan-isi {
            color: #555;
        }

        .no-tanggapan {
            font-style: italic;
            color: #888;
        }

        .pagination {
            display: flex;
            justify-content: center;
            list-style: none;
            margin-top: 20px;
        }

        .pagination li {
            margin: 0 5px;
        }

        .pagination li a, .pagination li span {
            display: block;
            padding: 5px 10px;
            border: 1px solid #41bfb3;
            border-radius: 4px;
            color: #41bfb3;
            text-decoration: none;
        }

        .pagination li.active span {
            background-color: #41bfb3;
            color: white;
        }

        .no-pesan {
            text-align: center;
            color: #888;
            margin-top: 40px;
        }

        #no-results-message {
            display: none;
            text-align: center;
            color: #888;
            margin-top: 40px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="profile">
                <img src="{{ asset('image/bgdepan.png') }}" alt="Foto Profil" class="avatar" />
                <h2>Hi, {{ $user->nama_lengkap ?? ($user->username ?? 'User') }} !!</h2>
            </div>
            <div class="notif">
                <img src="https://cdn-icons-png.flaticon.com/512/561/561127.png" alt="Mail" />
                @if($baru > 0)
                <div class="dot"></div>
                @endif
            </div>
        </div>

        <div class="menu">
            <a href="{{ route('user.dashboard') }}"><button>Beranda</button></a>
            <a href="{{ route('user.pesan') }}"><button>Pesan</button></a>
            <a href="{{ route('user.riwayat') }}"><button class="active">Riwayat</button></a>
        </div>

        <div class="riwayat-section">
            <h3>Riwayat Pesan</h3>

            <div class="kategori-filter">
                <button class="filter-btn active" data-kategori="semua">Semua</button>
                <button class="filter-btn" data-kategori="fasilitas">Fasilitas</button>
                <button class="filter-btn" data-kategori="pelayanan">Pelayanan</button>
            </div>

            @if($pesans->count() > 0)
                <div id="pesan-container">
                    @foreach($pesans as $pesan)
                    <div class="pesan-item" data-kategori="{{ strtolower($pesan->kategori) }}">
                        <div class="pesan-header">
                            <div class="pesan-judul">{{ $pesan->judul }}</div>
                            <div class="pesan-kategori">{{ $pesan->kategori }}</div>
                            <div class="pesan-tanggal">{{ $pesan->created_at->format('d M Y, H:i') }}</div>
                        </div>

                        <div>
                            <span class="pesan-status status-{{ strtolower($pesan->status) }}">{{ $pesan->status }}</span>
                        </div>

                        <div class="pesan-isi">
                            {{ $pesan->isi_pesan }}
                        </div>

                        @if($pesan->tanggapan)
                            <div class="pesan-tanggapan">
                                <div class="tanggapan-header">Tanggapan Admin:</div>
                                <div class="tanggapan-isi">{{ $pesan->tanggapan->isi_tanggapan }}</div>
                                <div class="pesan-tanggal">{{ $pesan->tanggapan->created_at->format('d M Y, H:i') }}</div>
                            </div>
                        @else
                            <div class="no-tanggapan">Belum ada tanggapan</div>
                        @endif
                    </div>
                    @endforeach
                </div>

                <div id="no-results-message">
                    Tidak ada pesan dengan kategori ini
                </div>

                <div class="pagination-container">
                    {{ $pesans->links() }}
                </div>
            @else
                <div class="no-pesan">Anda belum memiliki riwayat pesan</div>
            @endif

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const filterButtons = document.querySelectorAll('.filter-btn');
                    const pesanItems = document.querySelectorAll('.pesan-item');

                    filterButtons.forEach(button => {
                        button.addEventListener('click', function() {
                            const kategori = this.getAttribute('data-kategori');

                            // Update active button
                            filterButtons.forEach(btn => btn.classList.remove('active'));
                            this.classList.add('active');

                            // Filter messages
                            let visibleCount = 0;
                            pesanItems.forEach(item => {
                                if (kategori === 'semua' || item.getAttribute('data-kategori') === kategori) {
                                    item.style.display = 'block';
                                    visibleCount++;
                                } else {
                                    item.style.display = 'none';
                                }
                            });

                            // Show/hide no results message
                            const noResultsMessage = document.getElementById('no-results-message');
                            if (visibleCount === 0 && pesanItems.length > 0) {
                                noResultsMessage.style.display = 'block';
                            } else {
                                noResultsMessage.style.display = 'none';
                            }
                        });
                    });
                });
            </script>
        </div>
    </div>
</body>

</html>
