<?php

namespace App\Livewire\Dashboard\Permohonan\Admin;

use App\Models\User;
use Livewire\Component;
use App\Models\Notifikasi;
use Livewire\Attributes\On;
use App\Models\PendaftaranMerek;

class Tindakan extends Component
{
    public $nomorPermohonan;
    public $status_permohonan;
    public $pesan_revisi;
    public $pesan_penolakan;
    public $pesan_pencabutan_merek;
    public $pendaftaran_merek;

    public $profil_belum_lengkap = false;

    #[On('show-message')]
    public function mount()
    {
        $this->pendaftaran_merek = PendaftaranMerek::where('no_permohonan', $this->nomorPermohonan)->first();
        $this->status_permohonan = $this->pendaftaran_merek->status;

        $akun_pembuat_permohonan = User::where('email', $this->pendaftaran_merek->akun_pembuat_permohonan)->first();
        // jika profil user belum lengkap
        if ($akun_pembuat_permohonan->avatar == null || $akun_pembuat_permohonan->gender == null || $akun_pembuat_permohonan->birth_date == null || $akun_pembuat_permohonan->phone == null || $akun_pembuat_permohonan->job == null || $akun_pembuat_permohonan->company == null || $akun_pembuat_permohonan->bio == null || $akun_pembuat_permohonan->address == null) {
            $this->profil_belum_lengkap = true;
        }
    }

    public function terima()
    {
        // generate nomor pendaftaran
        $nomor_pendaftaran = 'RT' . now()->year . now()->month . now()->day . now()->hour . now()->minute . now()->second . auth()->user()->id;
        $nomor_pengumuman = 'AN' . now()->year . now()->month . now()->day . now()->hour . now()->minute . now()->second . auth()->user()->id;
        $pendaftaran_merek = PendaftaranMerek::where('no_permohonan', $this->nomorPermohonan)->first();
        $pendaftaran_merek->status = 4;
        $pendaftaran_merek->terdaftar = true;
        $pendaftaran_merek->no_pendaftaran = $nomor_pendaftaran;
        $pendaftaran_merek->nomor_pengumuman = $nomor_pengumuman;
        $pendaftaran_merek->tanggal_pengumuman = now();
        $pendaftaran_merek->tanggal_dimulai_perlindungan = now();
        $pendaftaran_merek->tanggal_berakhir_perlindungan = now()->addYears(5);
        $pendaftaran_merek->save();

        $this->dispatch('show-message', [
            'type' => 'success',
            'message' => 'Permohonan berhasil diterima. Merek telah terdaftar.'
        ]);

        // create notification
        Notifikasi::create([
            'nomor_pengumuman' => $nomor_pengumuman,
            'pendaftaran_merek_id' => $pendaftaran_merek->id,
            'akun_penerima_notifikasi' => $pendaftaran_merek->akun_pembuat_permohonan,
            'judul_notifikasi' => 'Permohonan Pendaftaran Merek ' . $pendaftaran_merek->nama_merek . ' Diterima!',
            'isi_notifikasi' => 'Permohonan pendaftaran merek ' . $pendaftaran_merek->nama_merek . ' dengan nomor permohonan ' . $pendaftaran_merek->no_permohonan . ' telah diterima. Merek telah terdaftar secara resmi dengan nomor pendaftaran ' . $nomor_pendaftaran . '.',
            'link_notifikasi' => route('permohonan.pendaftaran-merek.show', $pendaftaran_merek->no_permohonan),
        ]);
    }
    public function revisi()
    {
        $pendaftaran_merek = PendaftaranMerek::where('no_permohonan', $this->nomorPermohonan)->first();
        $pendaftaran_merek->status = 1;
        $pendaftaran_merek->catatan_pemeriksa = $this->pesan_revisi;
        $pendaftaran_merek->save();

        $this->dispatch('show-message', [
            'type' => 'success',
            'message' => 'Tindakan revisi berhasil dilakukan. Permohonan telah dikembalikan ke pemohon.'
        ]);

        // create notification
        Notifikasi::create([
            'pendaftaran_merek_id' => $pendaftaran_merek->id,
            'akun_penerima_notifikasi' => $pendaftaran_merek->akun_pembuat_permohonan,
            'judul_notifikasi' => 'Permohonan Pendaftaran Merek ' . $pendaftaran_merek->nama_merek . ' memerlukan revisi!',
            'isi_notifikasi' => 'Permohonan pendaftaran merek ' . $pendaftaran_merek->nama_merek . ' dengan nomor permohonan ' . $pendaftaran_merek->no_permohonan . ' memerlukan revisi. Silahkan perbaiki permohonan anda dengan mengikuti catatan pemeriksa',
            'link_notifikasi' => route('permohonan.pendaftaran-merek.show', $pendaftaran_merek->no_permohonan),
            'nomor_pengumuman' => null,
        ]);
    }
    public function tolak()
    {
        $pendaftaran_merek = PendaftaranMerek::where('no_permohonan', $this->nomorPermohonan)->first();
        $pendaftaran_merek->status = 3;
        $pendaftaran_merek->terdaftar = false;
        $pendaftaran_merek->catatan_pemeriksa = $this->pesan_penolakan;
        $pendaftaran_merek->save();

        $this->dispatch('show-message', [
            'type' => 'success',
            'message' => 'Tindakan penolakan berhasil dilakukan. Permohonan telah ditolak.'
        ]);

        // create notification
        Notifikasi::create([
            'pendaftaran_merek_id' => $pendaftaran_merek->id,
            'akun_penerima_notifikasi' => $pendaftaran_merek->akun_pembuat_permohonan,
            'judul_notifikasi' => 'Permohonan Pendaftaran Merek ' . $pendaftaran_merek->nama_merek . ' telah ditolak!',
            'isi_notifikasi' => 'Permohonan pendaftaran merek ' . $pendaftaran_merek->nama_merek . ' dengan nomor permohonan ' . $pendaftaran_merek->no_permohonan . ' telah ditolak. Jika anda merasa ada kesalahan, silahkan ajukan permohonan kembali.',
            'link_notifikasi' => route('permohonan.pendaftaran-merek.show', $pendaftaran_merek->no_permohonan),
            'nomor_pengumuman' => null,
        ]);
    }
    public function cabut()
    {
        $pendaftaran_merek = PendaftaranMerek::where('no_permohonan', $this->nomorPermohonan)->first();
        $pendaftaran_merek->status = 5;
        $pendaftaran_merek->terdaftar = false;
        $pendaftaran_merek->catatan_pemeriksa = $this->pesan_pencabutan_merek;
        $pendaftaran_merek->save();

        $this->dispatch('show-message', [
            'type' => 'success',
            'message' => 'Tindakan pencabutan merek berhasil dilakukan. Merek telah dicabut.'
        ]);

        Notifikasi::create([
            'pendaftaran_merek_id' => $pendaftaran_merek->id,
            'akun_penerima_notifikasi' => $pendaftaran_merek->akun_pembuat_permohonan,
            'judul_notifikasi' => 'Permohonan Pendaftaran Merek ' . $pendaftaran_merek->nama_merek . ' telah dicabut!',
            'isi_notifikasi' => 'Permohonan pendaftaran merek ' . $pendaftaran_merek->nama_merek . ' dengan nomor permohonan ' . $pendaftaran_merek->no_permohonan . ' telah dicabut. Silahkan buka permohonan untuk mengetahui sebab merek dicabut. Jika anda merasa ada kesalahan, silahkan ajukan permohonan kembali.',
            'link_notifikasi' => route('permohonan.pendaftaran-merek.show', $pendaftaran_merek->no_permohonan),
            'nomor_pengumuman' => null,
        ]);
    }
    public function render()
    {
        return view('livewire.dashboard.permohonan.admin.tindakan');
    }
}
