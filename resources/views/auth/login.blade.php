<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – Suara Kampus</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: sans-serif;
            background-color: #f5f5f5;
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
        }
        .login-wrapper {
            width: 360px;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .header {
            position: relative;
            height: 200px;
            background: url('{{ asset("images/campus.jpg") }}') center/cover no-repeat;
        }
        .header::after {
            content: "";
            position: absolute;
            bottom: -60px;
            right: -80px;
            width: 200px;
            height: 200px;
            background: #41bfb3;
            border-radius: 50%;
        }
        .header-overlay {
            position: absolute;
            inset: 0;
            background: rgba(65, 191, 179, 0.7);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #fff;
            text-align: center;
            padding: 0 20px;
        }
        .header-overlay h1 {
            font-size: 1.5rem;
            letter-spacing: 2px;
            margin-bottom: 0.5rem;
        }
        .header-overlay p {
            font-size: 0.9rem;
            opacity: 0.9;
        }
        .form-container {
            padding: 80px 30px 30px;
        }
        .form-container form {
            display: flex;
            flex-direction: column;
        }
        .form-container input {
            padding: 12px 15px;
            margin-bottom: 15px;
            border: 1.5px solid #41bfb3;
            border-radius: 8px;
            font-size: 0.95rem;
        }
        .form-container input::placeholder {
            color: #999;
        }
        .form-container button {
            background: #41bfb3;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }
        .form-container button:hover {
            background: #369e91;
        }
        .error {
            color: #e74c3c;
            font-size: 0.85rem;
            margin-top: -10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="header">
            <div class="header-overlay">
                <h1>SUARA KAMPUS</h1>
                <p>“Dari Mahasiswa, Untuk Perubahan”</p>
            </div>
        </div>
        <div class="form-container">
            <form action="{{ route('login') }}" method="POST">
                @csrf

                <input
                    type="email"
                    name="email"
                    id="email"
                    placeholder="Masukkan email USK"
                    value="{{ old('email') }}"
                >
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror

                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Masukkan Password"
                >
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror

                <button type="submit">LOGIN</button>
            </form>
        </div>
    </div>
</body>
</html>
