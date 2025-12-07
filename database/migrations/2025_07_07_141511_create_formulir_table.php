<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('formulir', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // 1. Data Sistem
            $table->string('nama_aplikasi');
            $table->string('domain_aplikasi')->nullable();
            $table->enum('ip_jenis', ['lokal', 'public'])->nullable(); // radio box lokal/public
            $table->string('ip_address')->nullable(); // input IP address server

            // 2. Data Pejabat Penandatangan NDA
            $table->string('pejabat_nama');
            $table->string('pejabat_nip');
            $table->string('pejabat_pangkat');
            $table->string('pejabat_jabatan');

            // 3 - 13: Pertanyaan Essay / Teks Panjang
            $table->text('tujuan_sistem')->nullable(); // no. 3
            $table->text('pengguna_sistem')->nullable(); // no. 4
            $table->text('hosting')->nullable(); // no. 5
            $table->string('framework')->nullable(); // no. 6
            $table->text('pengelola_sistem')->nullable(); // no. 7

            // 8. Hak Akses
            $table->integer('jumlah_roles')->nullable();
            $table->string('nama_roles')->nullable();

            // 9 - 12
            $table->text('mekanisme_account')->nullable();
            $table->text('mekanisme_kredensial')->nullable();
            $table->enum('fitur_reset_password', ['ada', 'tidak'])->nullable();
            $table->string('pic_pengelola')->nullable();

            // 13. Keterangan tambahan
            $table->text('keterangan_tambahan')->nullable();

            // 14. Umpan balik
            $table->text('balasan_admin')->nullable(); // Umpan balik/komentar admin
            $table->enum('status', ['diproses', 'revisi', 'selesai'])->default('diproses'); // Status permohonan
            $table->string('file_hasil_itsa')->nullable(); // File hasil ITSA dari admin (PDF)

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formulir');
    }
};