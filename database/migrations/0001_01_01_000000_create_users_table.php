<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Users
        Schema::create('users', function (Blueprint $table) {
            $table->id();                          // id
            $table->string('username')->unique();
            $table->string('password');
            $table->string('nama_lengkap');
            $table->string('email')->unique();
            $table->string('no_telepon')->nullable();
            $table->timestamp('tanggal_registrasi')->useCurrent();
            $table->timestamps();
        });

        // 2. Roles
        Schema::create('roles', function (Blueprint $table) {
            $table->id();                          // id
            $table->string('nama_role');
            $table->timestamps();
        });

        // 3. Pivot user_role
        Schema::create('role_user', function (Blueprint $table) {
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->foreignId('role_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->primary(['user_id','role_id']);
        });

        // 4. Mahasiswa (profil mahasiswa)
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();                          // id
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->string('npm')->unique();
            $table->string('jurusan');
            $table->string('fakultas');
            $table->year('angkatan');
            $table->timestamps();
        });

        // 5. Admins (profil admin)
        Schema::create('admins', function (Blueprint $table) {
            $table->id();                          // id
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->string('jabatan');
            $table->string('departemen');
            $table->timestamps();
        });

        // 6. Kategori kritik/saran
        Schema::create('kategoris', function (Blueprint $table) {
            $table->id();                          // id
            $table->string('nama_kategori');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        // 7. Kritik & Saran
        Schema::create('kritik_sarans', function (Blueprint $table) {
            $table->id();                          // id
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->string('judul');
            $table->text('isi_pesan');
            $table->dateTime('tanggal_kirim')->useCurrent();
            $table->enum('status',['baru','diproses','selesai'])
                  ->default('baru');
            $table->unsignedTinyInteger('prioritas')
                  ->default(1);
            $table->foreignId('kategori_id')
                  ->constrained('kategoris')
                  ->onDelete('restrict');
            $table->string('file_lampiran')->nullable();
            $table->timestamps();
        });

        // 8. Tanggapan Admin
        Schema::create('tanggapans', function (Blueprint $table) {
            $table->id();                          // id
            $table->foreignId('kritik_saran_id')
                  ->constrained('kritik_sarans')
                  ->onDelete('cascade');
            // kami anggap admin adalah user dengan role admin
            $table->foreignId('admin_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->dateTime('tanggal_tanggapan')->useCurrent();
            $table->text('isi_tanggapan');
            $table->enum('status_penyelesaian',['pending','selesai'])
                  ->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop in reverse order untuk menghindari foreign key errors
        Schema::dropIfExists('tanggapans');
        Schema::dropIfExists('kritik_sarans');
        Schema::dropIfExists('kategoris');
        Schema::dropIfExists('admins');
        Schema::dropIfExists('mahasiswa');
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('users');
    }
};
