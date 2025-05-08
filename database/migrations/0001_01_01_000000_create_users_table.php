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
            $table->string('nama');                 // Added nama field
            $table->string('judul');
            $table->text('pesan');                  // Changed from isi_pesan to pesan
            $table->string('tujuan');               // Added tujuan field
            $table->dateTime('tanggal_kirim')->useCurrent();
            $table->enum('status',['baru','proses','selesai'])  // Changed 'diproses' to 'proses'
                ->default('baru');
            $table->unsignedTinyInteger('prioritas')
                ->default(1);
            $table->string('kategori');
            $table->string('lampiran')->nullable(); // Changed from file_lampiran to lampiran
            $table->timestamps();
        });

        // 8. Tanggapan Admin
        Schema::create('tanggapans', function (Blueprint $table) {
            $table->id();                          // id
            $table->foreignId('kritik_saran_id')
                ->constrained('kritik_sarans')
                ->onDelete('cascade');
            $table->foreignId('admin_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->string('lampiran')->nullable();
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
