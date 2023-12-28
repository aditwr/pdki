<?php

namespace App\Livewire\Dashboard\Pengumuman;

use Livewire\Component;
use App\Models\Pengumuman;

class Lihat extends Component
{
    public $perPage = 10;

    public function render()
    {
        $pengumumans = Pengumuman::latest()->paginate($this->perPage);
        $pengumuman_aktif = Pengumuman::whereDate('tanggal_awal_pengumuman', "<=", date('Y-m-d'))->whereDate('tanggal_akhir_pengumuman', ">=", date('Y-m-d'))->latest()->paginate($this->perPage);
        $pengumuman_berlalu = Pengumuman::whereDate('tanggal_akhir_pengumuman', "<", date('Y-m-d'))->latest()->paginate($this->perPage);
        return view('livewire.dashboard.pengumuman.lihat', compact(['pengumuman_aktif', 'pengumuman_berlalu']));
    }
}
