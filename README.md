# Aplikasi Pengaduan dan Aspirasi Mahasiswa

## Informasi Pengembang
- **Nama:** Dio Ferdi Jaya
- **NIM:** 2308107010018

## Deskripsi Aplikasi
Aplikasi Pengaduan dan Aspirasi Mahasiswa adalah sebuah sistem berbasis web yang dirancang untuk memfasilitasi mahasiswa dalam menyampaikan kritik, saran, pengaduan, serta aspirasi mereka kepada pihak terkait di lingkungan kampus. Aplikasi ini bertujuan untuk menjembatani komunikasi antara mahasiswa dan pihak manajemen atau unit layanan kampus, sehingga masukan dari mahasiswa dapat ditindaklanjuti dengan lebih efektif dan transparan.

### Penjelasan Kode (Struktur dan Komponen Utama)
- **Teknologi Utama:**
    - Laravel [Sebutkan Versi Laravel Anda, misal: 10.x]
    - PHP [Sebutkan Versi PHP Anda, misal: 8.1+]
    - Composer (untuk manajemen dependensi PHP)
    - Database: MySQL (dijalankan melalui Laragon)
    - Frontend: HTML standar dan CSS (menggunakan file Blade Laravel untuk templating)
- **Struktur Direktori Penting (Contoh - sesuaikan dengan struktur proyek Anda):**
    - `app/Http/Controllers/`: Berisi controller yang menangani logika request.
        - `PengaduanController.php`: Mengelola logika untuk membuat, menampilkan, dan memproses pengaduan dari mahasiswa.
        - `TanggapanController.php`: Mengelola logika untuk admin dalam memberikan tanggapan terhadap pengaduan.
        - `AuthController.php`: Menangani proses autentikasi (login, register, logout) untuk mahasiswa dan admin.
    - `app/Models/`: Berisi model Eloquent yang berinteraksi dengan database.
        - `User.php`: Merepresentasikan tabel `users` (mahasiswa dan admin).
        - `Pengaduan.php`: Merepresentasikan tabel `pengaduans`, menyimpan detail pengaduan yang dikirim mahasiswa.
        - `Tanggapan.php`: Merepresentasikan tabel `tanggapans`, menyimpan balasan dari admin terhadap pengaduan.
    - `routes/web.php`: Mendefinisikan rute untuk aplikasi web, termasuk rute untuk autentikasi, dashboard, pengiriman pengaduan, dan pengelolaan tanggapan oleh admin.
    - `resources/views/`: Berisi file Blade untuk tampilan.
        - `auth/`: Folder berisi view untuk login dan register.
        - `user/`: Folder berisi view untuk dashboard mahasiswa, form pengaduan, dan riwayat pengaduan.
        - `admin/`: Folder berisi view untuk dashboard admin, daftar pengaduan, dan form tanggapan.
        - `layouts/app.blade.php`: File layout utama yang digunakan oleh view lain.
    - `database/migrations/`: Berisi file migrasi untuk skema database (tabel `users`, `pengaduans`, `tanggapans`, dll.).
    - `database/seeders/`: Berisi file seeder untuk membuat data awal (misalnya, akun admin default, beberapa kategori pengaduan).
- **Fitur Utama:**
    - **Autentikasi Pengguna:** Mahasiswa dan Admin dapat melakukan login, dan mahasiswa dapat melakukan registrasi.
    - **Pengiriman Pengaduan oleh Mahasiswa:** Mahasiswa yang sudah login dapat membuat dan mengirimkan pengaduan baru yang berisi judul, deskripsi/isi pesan, dan mungkin kategori atau tujuan pengaduan.
    - **Pemberian Tanggapan oleh Admin:** Admin dapat melihat daftar pengaduan yang masuk, membaca detailnya, dan memberikan tanggapan atau balasan terhadap pengaduan tersebut.
    - **Riwayat Pengaduan:** Mahasiswa dapat melihat riwayat pengaduan yang pernah mereka kirim beserta status dan tanggapan yang telah diberikan.
    - **Notifikasi (Opsional):** Pemberitahuan kepada mahasiswa ketika pengaduannya mendapatkan tanggapan.

### Tampilan Antarmuka (User Interface)
- **Halaman Login & Registrasi:** Antarmuka bagi mahasiswa untuk mendaftar dan masuk ke sistem, serta bagi admin untuk login.
- **Dashboard Mahasiswa:** Setelah login, mahasiswa akan melihat ringkasan aktivitasnya, mungkin daftar pengaduan terbaru, dan tombol untuk membuat pengaduan baru.
- **Form Pengaduan:** Halaman di mana mahasiswa dapat mengisi detail pengaduan mereka (judul, isi pesan, dll.) sebelum mengirimkannya.
- **Halaman Riwayat Pengaduan (Mahasiswa):** Menampilkan daftar pengaduan yang telah dikirim oleh mahasiswa, beserta status (misalnya, "Menunggu Tanggapan", "Sudah Ditanggapi") dan detail tanggapan jika ada.
- **Dashboard Admin:** Setelah login, admin akan melihat daftar pengaduan yang masuk, mungkin dengan filter atau urutan tertentu.
- **Halaman Detail Pengaduan & Form Tanggapan (Admin):** Admin dapat melihat detail lengkap sebuah pengaduan dan mengisi form untuk memberikan tanggapan.

## Cara Instalasi dan Menjalankan Aplikasi

### Prasyarat
Pastikan Anda telah menginstal perangkat lunak berikut di sistem Anda:
- PHP (versi [versi PHP Anda, misal: ^8.1])
- Composer
- Laragon (yang sudah termasuk MySQL, PHP, dan Apache/Nginx)
- Git

### Langkah-langkah Instalasi
1.  **Clone repository ini:**
    ```bash
    git clone [URL Git Repository Anda]
    cd [nama-folder-proyek]
    ```

2.  **Install dependensi PHP menggunakan Composer:**
    ```bash
    composer install
    ```

3.  **Salin file environment example dan buat file `.env`:**
    ```bash
    cp .env.example .env
    ```
    (Untuk Windows, jika menggunakan Command Prompt biasa, gunakan `copy .env.example .env`)

4.  **Generate application key:**
    ```bash
    php artisan key:generate
    ```

5.  **Konfigurasi file `.env`:**
    Buka file `.env` dan sesuaikan konfigurasi database Anda. Jika menggunakan Laragon dengan pengaturan default, biasanya seperti ini untuk MySQL:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database_proyek_anda  # Ganti dengan nama database yang Anda buat di Laragon
    DB_USERNAME=root
    DB_PASSWORD=                         # Biasanya kosong untuk default Laragon
    ```
    *Pastikan Anda sudah membuat database `nama_database_proyek_anda` melalui Laragon (misalnya via HeidiSQL atau tombol "Database" di Laragon).*

6.  **Jalankan migrasi database untuk membuat tabel-tabel:**
    ```bash
    php artisan migrate
    ```

7.  **(Opsional) Jalankan seeder untuk mengisi data awal (jika ada):**
    ```bash
    php artisan db:seed
    ```
    Anda juga bisa menggabungkan langkah 6 dan 7:
    ```bash
    php artisan migrate --seed
    ```

8.  **(Opsional, jika menggunakan penyimpanan publik) Buat symbolic link untuk storage:**
    ```bash
    php artisan storage:link
    ```

9.  **Jalankan server pengembangan Laravel:**
    (Pastikan Laragon Anda sudah berjalan, khususnya Apache/Nginx dan MySQL)
    ```bash
    php artisan serve
    ```
    Aplikasi akan berjalan di `http://127.0.0.1:8000` atau `http://localhost:8000`. Anda juga bisa mengaksesnya melalui Virtual Host yang dibuat Laragon jika sudah dikonfigurasi (misalnya `nama-proyek.test`).

---


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
