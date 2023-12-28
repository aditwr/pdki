<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\AksesMember;
use App\Models\Notifikasi;
use App\Models\PendaftaranMerek;
use App\Models\Pengumuman;

class Dashboard extends Component
{
    public $bulanAktif;
    public $tahunAktif;

    public $daftar_tanggal_bulan_ini;
    public $tanggal_terakhir_bulan_ini;
    public $permohonan_masuk_bulan_ini;

    public $permohonan_bulanan;
    public $permohonan_tahunan;
    public $daftar_tahun;

    public $akses_member_harian;
    public $akses_member_bulanan;
    public $akses_member_tahunan;
    public $perlu_lengkapi_profil = false;

    public function mount()
    {
        $this->bulanAktif = date('m');
        $this->tahunAktif = date('Y');

        // jika profil user belum lengkap
        if (auth()->user()->avatar == null || auth()->user()->gender == null || auth()->user()->birth_date == null || auth()->user()->phone == null || auth()->user()->job == null || auth()->user()->company == null || auth()->user()->bio == null || auth()->user()->address == null) {
            $this->perlu_lengkapi_profil = true;
        }
    }
    public function hitung_tanggal_bulan_aktif()
    {
        $number_of_days_in_selected_month = cal_days_in_month(CAL_GREGORIAN, date($this->bulanAktif), date($this->tahunAktif));
        $this->tanggal_terakhir_bulan_ini = $number_of_days_in_selected_month;
        $daftar_tanggal_bulan_ini = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28];
        if ($number_of_days_in_selected_month == 30) {
            array_push($daftar_tanggal_bulan_ini, 29, 30);
        } else if ($number_of_days_in_selected_month == 31) {
            array_push($daftar_tanggal_bulan_ini, 29, 30, 31);
        } else if ($number_of_days_in_selected_month == 29) {
            array_push($daftar_tanggal_bulan_ini, 29);
        }

        return $daftar_tanggal_bulan_ini;
    }

    public function hitung_permohonan_masuk_bulan_ini()
    {
        // hitung di setiap harinya
        $permohonan_masuk_bulan_ini = [];

        for ($i = 1; $i <= (int)$this->tanggal_terakhir_bulan_ini; $i++) {
            $permohonan_masuk_per_hari = PendaftaranMerek::whereMonth('created_at', $this->bulanAktif)->whereYear('created_at', $this->tahunAktif)->whereDay('created_at', $i)->count();
            array_push($permohonan_masuk_bulan_ini, $permohonan_masuk_per_hari);
        }
        return $permohonan_masuk_bulan_ini;
    }

    public function hitung_permohonan_bulanan()
    {
        $permohonan_bulanan = [];
        for ($i = 1; $i <= 12; $i++) {
            $permohonan_bulanan_per_bulan = PendaftaranMerek::whereMonth('created_at', $i)->whereYear('created_at', $this->tahunAktif)->count();
            array_push($permohonan_bulanan, $permohonan_bulanan_per_bulan);
        }

        return $permohonan_bulanan;
    }

    public function hitung_permohonan_tahunan()
    {
        $tahun_awal = (int)$this->tahunAktif - 5;
        $daftar_tahun = [];
        $permohonan_tahunan = [];

        for ($i = (int)$tahun_awal; $i <= (int)$this->tahunAktif; $i++) {
            $permohonan_tahunan_per_tahun = PendaftaranMerek::whereYear('created_at', $i)->count();
            array_push($permohonan_tahunan, $permohonan_tahunan_per_tahun);
            array_push($daftar_tahun, $i);
        }
        $this->permohonan_tahunan = $permohonan_tahunan;
        $this->daftar_tahun = $daftar_tahun;
    }

    public function hitung_akses_member_harian()
    {
        $akses_member_harian = [];
        for ($i = 1; $i <= (int)$this->tanggal_terakhir_bulan_ini; $i++) {
            $akses_member_per_hari = AksesMember::whereMonth('created_at', $this->bulanAktif)->whereYear('created_at', $this->tahunAktif)->whereDay('created_at', $i)->count();
            array_push($akses_member_harian, $akses_member_per_hari);
        }
        $this->akses_member_harian = $akses_member_harian;
    }
    public function hitung_akses_member_bulanan()
    {
        $akses_member_bulanan = [];
        for ($i = 1; $i <= 12; $i++) {
            $akses_member_bulanan_per_bulan = AksesMember::whereMonth('created_at', $i)->whereYear('created_at', $this->tahunAktif)->count();
            array_push($akses_member_bulanan, $akses_member_bulanan_per_bulan);
        }
        $this->akses_member_bulanan = $akses_member_bulanan;
    }
    public function hitung_akses_member_tahunan()
    {
        $akses_member_tahunan = [];
        for ($i = (int)$this->tahunAktif - 5; $i <= (int)$this->tahunAktif; $i++) {
            $akses_member_tahunan_per_tahun = AksesMember::whereYear('created_at', $i)->count();
            array_push($akses_member_tahunan, $akses_member_tahunan_per_tahun);
        }
        $this->akses_member_tahunan = $akses_member_tahunan;
    }

    public function rendered()
    {
    }

    public function render()
    {
        $this->daftar_tanggal_bulan_ini = $this->hitung_tanggal_bulan_aktif();
        $this->permohonan_masuk_bulan_ini = $this->hitung_permohonan_masuk_bulan_ini();
        $this->permohonan_bulanan = $this->hitung_permohonan_bulanan();
        $this->hitung_permohonan_tahunan();
        $this->hitung_akses_member_harian();
        $this->hitung_akses_member_bulanan();
        $this->hitung_akses_member_tahunan();

        $permohonan_perlu_verifikasi = PendaftaranMerek::where('status', 0)->orWhere('status', 2)->count();
        $permohonan_menunggu_verifikasi = PendaftaranMerek::where('akun_pembuat_permohonan', auth()->user()->email)->where('status', 0)->count();
        $notifikasi_belum_dibaca = Notifikasi::where('akun_penerima_notifikasi', auth()->user()->email)->where('dibaca', false)->count();
        $jumlah_pengumuman_aktif = Pengumuman::where('tanggal_awal_pengumuman', '<=', date('Y-m-d'))->where('tanggal_akhir_pengumuman', '>=', date('Y-m-d'))->count();
        $pengumuman_aktif = Pengumuman::whereDate('tanggal_awal_pengumuman', "<=", date('Y-m-d'))->whereDate('tanggal_akhir_pengumuman', ">=", date('Y-m-d'))->latest()->get();
        return view('livewire.dashboard.dashboard', compact([
            'permohonan_perlu_verifikasi',
            'permohonan_menunggu_verifikasi',
            'notifikasi_belum_dibaca',
            'jumlah_pengumuman_aktif',
            'pengumuman_aktif'
        ]));
    }
}
