@extends('layouts.app')

@section('title', 'Kirim Pesan')

@section('content')
<style>
    /* Copy style dari halaman-pesan-user.html, atau pindahkan ke file CSS terpisah */
    body {
        background-color: #f5f5f5;
    }
    .container {
        max-width: 600px;
        background: #fff;
        border: 1px solid #ccc;
        border-radius: 8px;
        margin: 40px auto;
        padding: 20px;
    }
    .header {
        background-color: #41bfb3;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border-radius: 10px;
        margin-bottom: 20px;
        color: white;
    }
    .menu {
        display: flex;
        justify-content: space-around;
        margin-bottom: 20px;
    }
    .menu a {
        padding: 8px 20px;
        border: 2px solid #41bfb3;
        border-radius: 20px;
        text-decoration: none;
        color: #41bfb3;
        font-weight: bold;
    }
    .menu .active {
        background: #41bfb3;
        color: white;
    }
    form {
        border: 2px solid #41bfb3;
        border-radius: 10px;
        padding: 20px;
        display: flex;
        flex-direction: column;
    }
    label {
        margin-top: 10px;
        margin-bottom: 5px;
        font-weight: bold;
    }
    input[type="text"],
    textarea,
    input[type="file"] {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 6px;
        width: 100%;
    }
    textarea {
        resize: vertical;
        min-height: 100px;
    }
    .submit-btn {
        margin-top: 20px;
        background-color: #41bfb3;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
        width: 150px;
        align-self: center;
    }
    .submit-btn:hover {
        background-color: #369e91;
    }
    .error {
        color: #e74c3c;
        font-size: 0.875em;
    }
    .alert {
        padding: 10px;
        background: #dff0d8;
        border: 1px solid #d0e9c6;
        border-radius: 5px;
        color: #3c763d;
        margin-bottom: 20px;
    }
</style>

<div class="container">
    <div class="header">
        <div>
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="User" width="30" height="30" style="border-radius:50%;">
            <span>Hi, {{ Auth::user()->name }}!</span>
        </div>
        <a href="{{ route('user.riwayat') }}" style="color:white; text-decoration:none;">
            <img src="https://cdn-icons-png.flaticon.com/512/561/561127.png" alt="Riwayat" width="30">
        </a>
    </div>

    <div class="menu">
        <a href="{{ route('user.dashboard') }}">Beranda</a>
        <a href="{{ route('user.pesan') }}" class="active">Pesan</a>
        <a href="{{ route('user.riwayat') }}">Riwayat</a>
    </div>

    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('user.pesan') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="judul">Judul:</label>
        <input type="text" name="judul" id="judul" value="{{ old('judul') }}" placeholder="Masukkan judul">
        @error('judul')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="pesan">Pesan:</label>
        <textarea name="pesan" id="pesan" placeholder="Masukkan Kritik dan Saran">{{ old('pesan') }}</textarea>
        @error('pesan')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="lampiran">Lampiran (jpg, png, pdf max 2MB):</label>
        <input type="file" name="lampiran" id="lampiran" accept=".jpg,.jpeg,.png,.pdf">
        @error('lampiran')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit" class="submit-btn">KIRIM</button>
    </form>
</div>
@endsection
