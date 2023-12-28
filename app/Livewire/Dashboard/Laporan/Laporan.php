<?php

namespace App\Livewire\Dashboard\Laporan;

use Livewire\Component;
use App\Models\PendaftaranMerek;
use Livewire\Attributes\On;

class Laporan extends Component
{
    public $tanggalAwal, $tanggalAkhir;
    public $pendaftaran_mereks;

    public function resetFilter()
    {
        $this->tanggalAwal = null;
        $this->tanggalAkhir = null;
    }
    public function updatedTanggalAwal()
    {
        $this->getPendaftaranMerek();
    }
    public function updatedTanggalAkhir()
    {
        $this->getPendaftaranMerek();
    }
    public function gunakanFilter()
    {
        $this->render();
    }
    public function getPendaftaranMerek()
    {
        $query = PendaftaranMerek::query();
        if ($this->tanggalAwal) {
            $query->where('created_at', '>=', $this->tanggalAwal);
        }
        if ($this->tanggalAkhir) {
            $query->where('created_at', '<=', $this->tanggalAkhir);
        }
        if ($this->tanggalAwal && $this->tanggalAkhir) {
            $query->whereBetween('created_at', [$this->tanggalAwal, $this->tanggalAkhir]);
        }
        $this->pendaftaran_mereks = PendaftaranMerek::latest()->get();
    }

    #[On('updatedTanggalAwal')]
    public function render()
    {
        $this->getPendaftaranMerek();
        // $pendaftaran_mereks = $this->getPendaftaranMerek();
        return view('livewire.dashboard.laporan.laporan');
    }
}
