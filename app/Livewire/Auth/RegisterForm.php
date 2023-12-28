<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;

class RegisterForm extends Component
{
    #[Validate('required|min:5')]
    public $name;
    #[Validate('required|email|unique:users,email')]
    public $email;
    #[Validate('required|min:5')]
    public $password;
    #[Validate('required|same:password')]
    public $confirmPassword;

    public function register()
    {
        // Create user
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
        // Login user
        auth()->login($user);
        // Redirect to dashboard
        return redirect()->route('dashboard');
    }
    public function render()
    {
        return view('livewire.auth.register-form');
    }
}
