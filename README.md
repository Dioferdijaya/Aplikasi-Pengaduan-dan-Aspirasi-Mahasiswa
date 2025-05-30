<div align="center">
  
  <h1>Aplikasi Pengaduan dan Aspirasi Mahasiswa</h1>
  <p>
    <strong>Sebuah platform untuk menyalurkan suara mahasiswa demi kemajuan bersama.</strong>
  </p>
  <p>
    <img src="https://img.shields.io/badge/Laravel-[VERSI_LARAVEL_ANDA]-FF2D20?style=for-the-badge&logo=laravel" alt="Laravel Version"/>
    <img src="https://img.shields.io/badge/PHP-[VERSI_PHP_ANDA]-777BB4?style=for-the-badge&logo=php" alt="PHP Version"/>
    <img src="https://img.shields.io/badge/Database-MySQL-00758F?style=for-the-badge&logo=mysql" alt="Database MySQL"/>
    <!-- Tambahkan badge lain jika perlu, misal untuk frontend framework -->
  </p>
</div>

---

## 👨‍💻 Informasi Pengembang
- **Nama:** Dio Ferdi Jaya
- **NIM:** 2308107010018

---

## 🚀 Deskripsi Aplikasi
Aplikasi Pengaduan dan Aspirasi Mahasiswa adalah sebuah sistem berbasis web yang dirancang untuk memfasilitasi mahasiswa dalam menyampaikan kritik, saran, pengaduan, serta aspirasi mereka kepada pihak terkait di lingkungan kampus. Aplikasi ini bertujuan untuk menjembatani komunikasi antara mahasiswa dan pihak manajemen atau unit layanan kampus, sehingga masukan dari mahasiswa dapat ditindaklanjuti dengan lebih efektif dan transparan.

---

## 🛠️ Penjelasan Teknis

### ⚙️ Teknologi Utama
- **Framework Backend:** Laravel `[Versi Laravel Anda, misal: 10.x]`
- **Bahasa Pemrograman:** PHP `[Versi PHP Anda, misal: 8.1+]`
- **Manajemen Dependensi:** Composer
- **Database:** MySQL (dijalankan melalui Laragon)
- **Frontend:** HTML5, CSS3 (menggunakan file Blade Laravel untuk templating)

### 📁 Struktur Direktori Penting
Berikut adalah beberapa direktori dan file kunci dalam struktur proyek:
- `app/Http/Controllers/`:
    - `PengaduanController.php`: Mengelola logika untuk membuat, menampilkan, dan memproses pengaduan dari mahasiswa.
    - `TanggapanController.php`: Mengelola logika untuk admin dalam memberikan tanggapan terhadap pengaduan.
    - `AuthController.php`: Menangani proses autentikasi (login, register, logout).
- `app/Models/`:
    - `User.php`: Merepresentasikan tabel `users` (mahasiswa dan admin).
    - `Pengaduan.php`: Merepresentasikan tabel `pengaduans`.
    - `Tanggapan.php`: Merepresentasikan tabel `tanggapans`.
- `routes/web.php`: Mendefinisikan rute utama aplikasi.
- `resources/views/`: Berisi file Blade untuk antarmuka pengguna.
    - `auth/`: Tampilan login dan registrasi.
    - `user/`: Tampilan untuk mahasiswa (dashboard, form pengaduan, riwayat).
    - `admin/`: Tampilan untuk admin (dashboard, daftar pengaduan, form tanggapan).
- `database/migrations/`: Skema database.
- `database/seeders/`: Data awal untuk pengembangan.

### ✨ Fitur Utama
- **🔐 Autentikasi Pengguna:** Sistem login dan registrasi yang aman untuk mahasiswa dan admin.
- **📨 Pengiriman Pengaduan:** Mahasiswa dapat dengan mudah mengirimkan pengaduan, saran, atau aspirasi.
- **💬 Pemberian Tanggapan:** Admin dapat melihat dan merespons pengaduan yang masuk.
- **📜 Riwayat Pengaduan:** Mahasiswa dapat melacak status dan riwayat pengaduan mereka.
- **📊 Dashboard Informatif:** Ringkasan aktivitas untuk mahasiswa dan admin.

---

## 🖥️ Tampilan Antarmuka (User Interface)
Aplikasi ini dirancang dengan antarmuka yang bersih dan intuitif untuk memudahkan pengguna.

- **Halaman Login & Registrasi:** Proses masuk dan pendaftaran yang sederhana.
- **Dashboard Mahasiswa:** Menampilkan ringkasan pengaduan dan navigasi mudah.
- **Form Pengaduan:** Formulir yang jelas untuk menyampaikan masukan.
- **Dashboard Admin:** Menyajikan daftar pengaduan yang perlu ditindaklanjuti.

*(Disarankan untuk menyertakan beberapa screenshot di sini atau link ke folder screenshot untuk visualisasi yang lebih baik)*
Contoh:
`![Screenshot Dashboard](link_ke_screenshot_dashboard.png)`

---

## 🚀 Cara Instalasi dan Menjalankan Aplikasi

### ✅ Prasyarat
Sebelum memulai, pastikan sistem Anda telah terinstal:
- PHP (versi `[versi PHP Anda, misal: ^8.1]`)
- Composer
- Laragon (termasuk MySQL, PHP, Apache/Nginx)
- Git

### 📋 Langkah-langkah Instalasi
1.  **Clone repository ini:**
    ```bash
    git clone [URL Git Repository ]
    cd [nama-folder-proyek]
    ```

2.  **Install dependensi PHP:**
    ```bash
    composer install
    ```

3.  **Buat file environment `.env`:**
    Salin dari file contoh:
    ```bash
    cp .env.example .env
    ```
    *(Windows CMD: `copy .env.example .env`)*

4.  **Generate application key:**
    ```bash
    php artisan key:generate
    ```

5.  **Konfigurasi Database di `.env`:**
    Buka file `.env` dan sesuaikan detail koneksi database Anda. Contoh untuk MySQL di Laragon:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database_proyek_anda  # GANTI INI
    DB_USERNAME=root
    DB_PASSWORD=                         # Biasanya kosong
    ```
    **Penting:** Buat database dengan nama `nama_database_proyek_anda` melalui Laragon (misalnya via HeidiSQL).

6.  **Jalankan Migrasi Database:**
    Perintah ini akan membuat semua tabel yang dibutuhkan:
    ```bash
    php artisan migrate
    ```

7.  **(Opsional) Jalankan Seeder (jika ada):**
    Untuk mengisi data awal ke database:
    ```bash
    php artisan db:seed
    ```
    Atau gabungkan dengan migrasi: `php artisan migrate --seed`

8.  **(Opsional) Symbolic Link untuk Storage:**
    Jika aplikasi Anda menggunakan penyimpanan publik:
    ```bash
    php artisan storage:link
    ```

9.  **Jalankan Aplikasi:**
    (Pastikan Laragon (Apache/Nginx & MySQL) Anda berjalan)
    ```bash
    php artisan serve
    ```
    Buka browser dan akses `http://127.0.0.1:8000` atau `http://localhost:8000`. Anda juga bisa menggunakan Virtual Host dari Laragon (misal: `nama-proyek.test`).

---

<div align="center">
  Made with  by Dio Ferdi Jaya
partner Abdurrahman Marzuki
</div>


<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
