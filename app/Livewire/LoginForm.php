<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginForm extends Component
{

    public string $email = '';
    public string $password = '';

    public function login()
    {
        $credentials = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            session()->regenerate();

            $user = Auth::user();

            return redirect()->to($user->role === 'admin' ? '/dashboard' : '/cardapio');
        }

        $this->addError('email', 'E-mail ou senha incorretos.');
    }

    public function render()
    {
        return view('livewire.login-form');
    }
}
