<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kritik_sarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained()          // relasi ke table users
                  ->onDelete('cascade');
            $table->string('judul');
            $table->text('pesan');
            $table->string('lampiran')->nullable();
            $table->enum('status', ['baru','proses','selesai'])
                  ->default('baru');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kritik_sarans');
    }
};
