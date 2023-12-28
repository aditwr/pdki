<?php

namespace App\Livewire\Dashboard\Notifikasi;

use Livewire\Component;
use App\Models\Notifikasi;
use Livewire\WithPagination;

class Lihat extends Component
{
    use WithPagination;

    public $perPage = 10;
    public function baca($id)
    {
        $notifikasi = Notifikasi::find($id);
        $notifikasi->update([
            'dibaca' => true
        ]);
        $this->dispatch('updateNotifikasi');
    }
    public function render()
    {
        $notifikasis = Notifikasi::where('akun_penerima_notifikasi', auth()->user()->email)->orderBy('created_at', 'desc')->paginate($this->perPage);
        return view('livewire.dashboard.notifikasi.lihat', compact(['notifikasis']));
    }
}
