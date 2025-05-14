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
            $table->string('NPM')->unique();
            $table->string('password');
            $table->string('nama_lengkap');
            $table->string('email')->unique();
            $table->string('no_telepon')->nullable();
            $table->enum('role',['admin','mahasiswa'])
                  ->default('mahasiswa');
            $table->timestamp('tanggal_registrasi')->useCurrent();
            $table->timestamps();
        });


        // 4. Mahasiswa (profil mahasiswa)
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();                          // id
            $table->foreignId('user_id')
                  ->constrained("users")
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
                  ->constrained("users")
                  ->onDelete('cascade');
            $table->string('jabatan');
            $table->string('departemen');
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

        // 9. Sessions (Laravel DB session driver)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop in reverse order untuk menghindari foreign key errors
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('tanggapans');
        Schema::dropIfExists('kritik_sarans');
        Schema::dropIfExists('admins');
        Schema::dropIfExists('mahasiswa');
        Schema::dropIfExists('users');
    }
};
