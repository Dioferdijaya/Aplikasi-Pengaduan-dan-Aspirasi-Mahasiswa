<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tanggapans', function (Blueprint $table) {
            $table->id();
            // relasi ke kritik_sarans
            $table->foreignId('kritik_saran_id')
                  ->constrained('kritik_sarans')
                  ->onDelete('cascade');
            // relasi ke users (admin)
            $table->foreignId('admin_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            // isi tanggapan
            $table->text('isi_tanggapan');
            // tanggal tanggapan (bisa pakai created_at juga)
            $table->timestamp('tanggal')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tanggapans');
    }
};
