<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Mahasiswa</title>
  {{-- Menggunakan helper asset() untuk path CSS --}}
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  {{-- Link Font Awesome dari CDN (tidak diubah) --}}
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
  
  
  .message-box, .reply-box {
    background: #f6f6f6;
    padding: 12px;
    border-radius: 10px;
    margin: 8px 0;
    border-left: 4px solid #278a76;
  }
  
  .date {
    font-size: 12px;
    color: gray;
    margin-top: 6px;
  }
  
  .rating-section {
    text-align: center;
    margin-top: 16px;
  }
  
  .stars button {
    font-size: 20px;
    background: none;
    border: none;
    cursor: pointer;
    color: #ccc;
  }
  
  .stars button:hover,
  .stars button:hover ~ button {
    color: gold;
  }
  
  .rate-btn {
    background: #278a76;
    color: white;
    padding: 8px 12px;
    border: none;
    border-radius: 20px;
    margin-top: 8px;
    cursor: pointer;
  }

  .datauser{
    font-size: 12px;
  }
  
.icon {
  width: 40px;
  height: 40px;
  vertical-align: middle;
}
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <div class="welcome">
        {{-- Menggunakan helper asset() untuk gambar avatar --}}
        <img src="{{ asset('image/bgdepan.png') }}" alt="Foto Profil" class="avatar" />
        {{-- Placeholder untuk nama user. Diasumsikan controller akan melewatkan variabel $user --}}
        {{-- Menggunakan ?? 'User' sebagai fallback jika $user tidak terdefinisi atau nama kosong --}}
        <h2>Hi, {{ $user->nama_lengkap ?? $user->username ?? 'User' }} !!</h2>
      </div>
      <div class="notif">
        <i class="fas fa-envelope"></i>
        {{-- Menggunakan variabel $baru dari controller --}}
        @if(isset($baru) && $baru > 0)
          <span class="badge">{{ $baru }}</span>
        @endif
      </div>
    </div>

    <div class="nav">
      {{-- Menggunakan helper route() untuk tautan navigasi --}}
      <a href="{{ route('user.dashboard') }}"><button class="active" >Beranda</button></a>
      <a href="{{ route('user.pesan') }}"><button>Pesan</button></a>
      <a href="{{ route('user.riwayat') }}"><button>Riwayat</button></a>
    </div>

    <div class="profile-box">
        {{-- Menggunakan helper asset() untuk gambar profil --}}
        <img src="{{ asset('image/bgdepan.png') }}" alt="Foto Profil" />
      <div class="profile-text">
        {{-- Menggunakan data user yang sudah dipastikan tersedia --}}
        <strong>{{ $user->nama_lengkap ?? 'Nama User' }} - {{ $user->NPM ?? 'NIM Tidak Tersedia' }}</strong>
        {{-- Mengecek apakah relasi mahasiswa ada sebelum menampilkan detailnya --}}
        @if(isset($user->mahasiswa))
            <p class="datauser">
                Jenjang {{ $user->mahasiswa->jenjang ?? 'Tidak Tersedia' }} |
                Fakultas {{ $user->mahasiswa->fakultas ?? 'Tidak Tersedia' }} |
                Jurusan {{ $user->mahasiswa->jurusan ?? 'Tidak Tersedia' }}
            </p>
        @else
             <p class="datauser">Detail mahasiswa tidak tersedia.</p>
        @endif
      </div>
    </div>

    <div class="section-title">Kritik dan Saran</div>

    <div class="suggestion-box">
      {{-- Menggunakan helper route() untuk tautan Kirim Kritik --}}
      <a href="{{ route('user.pesan') }}" class="suggestion-link">
        {{-- Menggunakan helper asset() untuk ikon --}}
        <img src="{{ asset('image/image.png') }}" alt="Ikon Kritik Saran" class="icon"> Suaramu, Arah Baru untuk Kampus Kita
      </a>
      <i class="fas fa-chevron-right"></i>
    </div>

    <div class="section-title">Tanggapan</div>

    {{-- Menampilkan kritik/saran terbaru yang dikirim oleh mahasiswa tersebut --}}
    @if(isset($latestKritikSaran))
        {{-- Tampilkan kotak kritik/saran --}}
        <div class="message-box">
          <p><strong>From:</strong> {{ $user->nama_lengkap ?? $user->username ?? 'Anonymous' }}</p>
          <p><strong>To:</strong> {{ $latestKritikSaran->tujuan ?? 'Fakultas MIPA' }}</p>
          <p><strong>Judul:</strong> {{ $latestKritikSaran->judul ?? 'Tidak ada judul' }}</p>
          <p><strong>Pesan:</strong> {{ $latestKritikSaran->pesan ?? 'Pesan tidak tersedia.' }}</p>
          <p class="date">{{ $latestKritikSaran->created_at ? $latestKritikSaran->created_at->format('d F Y H:i') : 'Tanggal tidak tersedia' }}</p>
        </div>

        {{-- Cek apakah kritik/saran ini memiliki tanggapan --}}
        @if(isset($latestKritikSaran->tanggapan))
            {{-- Tampilkan kotak tanggapan jika ada --}}
            <div class="reply-box">
              <p><strong>From:</strong> Admin {{ $latestKritikSaran->tanggapan->admin->nama ?? 'Fakultas MIPA' }}</p>
              <p><strong>To:</strong> {{ $user->nama_lengkap ?? $user->username ?? 'Anonymous' }}</p>
              <p><strong>Pesan:</strong> {{ $latestKritikSaran->tanggapan->isi_tanggapan ?? 'Isi tanggapan tidak tersedia.' }}</p>
              <p class="date">{{ $latestKritikSaran->tanggapan->created_at ? $latestKritikSaran->tanggapan->created_at->format('d F Y H:i') : 'Tanggal tidak tersedia' }}</p>
            </div>

            {{-- Rating Section --}}
            <div class="rating-section">
              <p>Apakah tanggapan memuaskan?</p>
              <div class="stars">
                <button>★</button>
                <button>★</button>
                <button>★</button>
                <button>★</button>
                <button>★</button>
              </div>
              <button class="rate-btn">Beri Rating Tanggapan</button>
            </div>
        @else
            {{-- Tampilkan pesan jika belum ada tanggapan --}}
            <div class="reply-box">
                <p>Belum ada tanggapan untuk kritik/saran ini.</p>
                <p class="date">Status: {{ ucfirst($latestKritikSaran->status) }}</p>
            </div>
        @endif
    @else
        {{-- Tampilkan pesan jika user belum mengirim kritik atau saran sama sekali --}}
        <div class="message-box">
            <p>Anda belum mengirim kritik atau saran.</p>
        </div>
    @endif
  </div>
</body>
</html>