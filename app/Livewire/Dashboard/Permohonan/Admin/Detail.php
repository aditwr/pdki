<?php

namespace App\Livewire\Dashboard\Permohonan\Admin;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class Detail extends Component
{
    public $pendaftaran_merek;
    #[On('show-message')]
    public function refresh()
    {
        $this->dispatch('refresh');
    }

    public function render()
    {
        $akun_pembuat_permohonan = User::where('email', $this->pendaftaran_merek->akun_pembuat_permohonan)->first();
        return view('livewire.dashboard.permohonan.admin.detail', compact(['akun_pembuat_permohonan']));
    }
}
