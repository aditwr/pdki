<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Validate;
use Livewire\Component;

class LoginForm extends Component
{
    #[Validate('required|email')]
    public $email;
    #[Validate('required|min:5')]
    public $password;

    public function login()
    {
        $this->validate();
        auth()->attempt(['email' => $this->email, 'password' => $this->password]);
        return redirect()->route('dashboard');
    }
    public function render()
    {
        return view('livewire.auth.login-form');
    }
}
