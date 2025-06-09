<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class RegisterForm extends Component
{

    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register()
    {
        try {
            $this->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed|min:5'
            ], [
                'name.required' => 'O nome é obrigatório.',
                'email.required' => 'O e-mail é obrigatório.',
                'email.email' => 'Digite um e-mail válido.',
                'email.unique' => 'Este e-mail já está em uso.',
                'password.required' => 'A senha é obrigatória.',
                'password.confirmed' => 'As senhas não coincidem.',
                'password.min' => 'A senha deve ter pelo menos 5 caracteres.',
            ]);

            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'role' => 'customer',
            ]);

            Auth::login($user);

            $this->dispatch('show-notification', [
                'message' => 'Conta criada com sucesso! Redirecionando...',
                'type' => 'success',
                'duration' => 3000
            ]);

            $this->js('setTimeout(() => { window.location.href = "' . route('cardapio') . '"; }, 2000);');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            $errorMessage = implode(' ', $errors);

            $this->dispatch('show-notification', [
                'message' => $errorMessage,
                'type' => 'error',
                'duration' => 6000
            ]);
        } catch (\Exception $e) {
            $this->dispatch('show-notification', [
                'message' => 'Erro interno. Tente novamente.',
                'type' => 'error',
                'duration' => 5000
            ]);
        }
    }

    public function render()
    {
        return view('livewire.register-form');
    }
}
