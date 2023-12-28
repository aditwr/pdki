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
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_merek_id')->constrained('pendaftaran_mereks')->onDelete('cascade');
            $table->string('akun_penerima_notifikasi');
            $table->string('judul_notifikasi');
            $table->text('isi_notifikasi');
            $table->boolean('dibaca')->default(false);
            $table->string('link_notifikasi')->nullable()->default(null);
            $table->string('nomor_pengumuman')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasis');
    }
};
