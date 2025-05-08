<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pesan Mahasiswa</title>
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
    width: 100%;
    /* width: 350px; */
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

  .form-section {
    padding: 10px;
  }

  .form-section h3 {
    margin-bottom: 10px;
  }

  form {

    border: 2px solid #41bfb3;
    border-radius: 10px;
    padding: 10px;
    display: flex;
    flex-direction: column;
    margin-bottom: 20px;


  }

  form label {
    font-size: 0.9em;
    margin: 5px 0 3px;
  }

  form select,
  form textarea,
  form input {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 6px;
    margin-bottom: 10px;
    resize: none;
  }

  form textarea {
    height: 120px;
  }

  .submit-btn {
    background-color: #41bfb3;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s;
    width: 35%;
  }

  .submit-btn:hover {
    background-color: #369e91;
  }

  .button-container{
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
  }

  .alert {
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 8px;
    font-size: 14px;
  }

  .alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
  }

  .alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
  }

  .file-input {
    margin-top: 10px;
  }
 </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <div class="profile">
        <img src="{{ asset('image/bgdepan.png') }}" alt="Foto Profil" class="avatar" />
        <h2>Hi, {{ $user->nama_lengkap ?? $user->username ?? 'User' }} !!</h2>
      </div>
      <div class="notif">
        <img src="https://cdn-icons-png.flaticon.com/512/561/561127.png" alt="Mail" />
        @if(isset($baru) && $baru > 0)
          <div class="dot"></div>
        @endif
      </div>
    </div>

    <div class="menu">
        <a href="{{ route('user.dashboard') }}"><button>Beranda</button></a>
        <a href="{{ route('user.pesan') }}"><button class="active">Pesan</button></a>
        <a href="{{ route('user.riwayat') }}"><button>Riwayat</button></a>
    </div>

    <div class="form-section">
        <h2>Masukan Kritik Dan Saran</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="nama">From :</label>
                <input type="text" class="form-control" value="{{ $user->nama_lengkap ?? 'Anonymous' }}" readonly>
            </div>

            <div class="form-group">
                <label for="tujuan">To :</label>
                <select name="tujuan" class="form-control" required>
                    <option value="">-- Pilih Tujuan --</option>
                    <option value="Fakultas MIPA">Fakultas MIPA</option>
                    <option value="Fakultas Teknik">Fakultas Teknik</option>
                    <option value="Fakultas Ekonomi">Fakultas Ekonomi</option>
                    <option value="Fakultas Hukum">Fakultas Hukum</option>
                    <option value="Fakultas Kedokteran">Fakultas Kedokteran</option>
                </select>
            </div>

            <div class="form-group">
                <label for="kategori_id">Kategori :</label>
                <select name="kategori_id" class="form-control">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="judul">Judul :</label>
                <input type="text" name="judul" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="pesan">Pesan :</label>
                <textarea name="pesan" class="form-control" rows="5" required></textarea>
            </div>

            <div class="form-group">
                <label for="lampiran">Lampiran (opsional) :</label>
                <input type="file" name="lampiran" class="form-control">
                <small class="text-muted">Format: JPG, PNG, PDF (Max: 2MB)</small>
            </div>

            <button type="submit" class="btn btn-primary">KIRIM</button>
        </form>
    </div>
  </div>
</body>
</html>
