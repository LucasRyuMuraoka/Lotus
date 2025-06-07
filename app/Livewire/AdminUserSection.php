<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSection extends Component
{

    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $role = 'customer';

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:5',
            'role' => 'required|in:customer,admin',
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
        ]);

        $this->reset(['name', 'email', 'password', 'password_confirmation', 'role']);
        session()->flash('message', 'Usuário criado com sucesso!');
    }

    public function delete(int $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        session()->flash('message', 'Usuário excluído com sucesso!');
    }

    public function render()
    {
        return view('livewire.admin-user-section', [
            'users' => User::latest()->get(),
        ]);
    }
}
