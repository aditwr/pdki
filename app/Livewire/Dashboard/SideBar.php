<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Notifikasi;
use App\Models\PendaftaranMerek;
use App\Models\Pengumuman;
use Livewire\Attributes\On;

class SideBar extends Component
{
    public $jumlah_notifikasi_belum_dibaca;
    public $jumlah_permohonan_baru;
    public $pengumuman_aktif;
    public $users_need_verification;

    public function mount()
    {
        $this->jumlah_notifikasi_belum_dibaca = Notifikasi::where('akun_penerima_notifikasi', auth()->user()->email)->where('dibaca', false)->count();
        $this->jumlah_permohonan_baru = PendaftaranMerek::where('status', 0)->count();
        $this->pengumuman_aktif = Pengumuman::whereDate('tanggal_awal_pengumuman', "<=", date('Y-m-d'))->whereDate('tanggal_akhir_pengumuman', ">=", date('Y-m-d'))->count();
        $this->users_need_verification = \App\Models\User::where('email_verified_at', null)->count();
    }

    #[On('updateNotifikasi')]
    public function updateNotifikasi()
    {
        $this->jumlah_notifikasi_belum_dibaca = Notifikasi::where('akun_penerima_notifikasi', auth()->user()->email)->where('dibaca', false)->count();
        $this->dispatch('jumlah_notifikasi_belum_dibaca', $this->jumlah_notifikasi_belum_dibaca);
    }
    #[On('updatePermohonanBaru')]
    public function updatePermohonanBaru()
    {
        $this->jumlah_permohonan_baru = PendaftaranMerek::where('status', 0)->count();
        $this->dispatch('jumlah_permohonan_baru', $this->jumlah_permohonan_baru);
    }

    public function render()
    {
        return view('livewire.dashboard.side-bar');
    }
}
