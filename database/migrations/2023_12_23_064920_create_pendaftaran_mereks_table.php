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
        Schema::create('pendaftaran_mereks', function (Blueprint $table) {
            $table->id();
            $table->string('no_permohonan')->unique();
            $table->string('nama_merek');
            $table->string('logo_merek');
            $table->text('translasi')->nullable()->default(null);
            $table->text('jenis_barang_jasa');
            $table->integer('kelas_barang_jasa');
            $table->string('surat_keterangan_umk')->nullable()->default(null);
            $table->string('pemohon');
            $table->string('alamat_pemohon');
            $table->string('no_telepon_pemohon');
            $table->string('tanda_tangan_pemohon');
            $table->string('kewarganegaraan_pemohon');
            $table->string('konsultan')->nullable()->default(null);
            $table->string('alamat_konsultan')->nullable()->default(null);
            $table->string('no_telepon_konsultan')->nullable()->default(null);
            $table->string('kewarganegaraan_konsultan')->nullable()->default(null);
            $table->string('akun_pembuat_permohonan');
            $table->string('akun_pemeriksa')->nullable()->default(null);
            $table->tinyInteger('status')->default(0);
            $table->boolean('terdaftar')->default(false);
            $table->string('no_pendaftaran')->unique()->nullable()->default(null);
            $table->date('tanggal_penerimaan')->nullable()->default(null);
            $table->date('tanggal_dimulai_perlindungan')->nullable();
            $table->date('tanggal_berakhir_perlindungan')->nullable();
            $table->text('catatan_pemeriksa')->nullable()->default(null);
            $table->string('nomor_pengumuman')->nullable()->default(null);
            $table->date('tanggal_pengumuman')->nullable()->default(null);
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_mereks');
    }
};
