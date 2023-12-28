<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use Livewire\Attributes\On;

class Dashboard extends Component
{
    public $state = false;

    #[On('searchIsCompleted')]
    public function searchIsCompleted($response)
    {
        $this->state = true;
    }
    public function render()
    {
        return view('livewire.guest.dashboard');
    }
}
