<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Url;
use Livewire\Component;

class AccountSection extends Component
{

    #[Url]
    public string $tab = 'perfil';

    public string $name;
    public string $email;
    public string $cpf;
    public string $phone;
    public string $birthDate;
    public string $password;
    public string $password_confirmation;

    public string $originalName;
    public string $originalEmail;
    public string $originalCpf;
    public string $originalPhone;
    public string $originalBirthDate;


    public function mount()
    {
        $user = Auth::user();

        $this->name = $user->name;
        $this->email = $user->email;
        $this->cpf = $user->cpf ?? '';
        $this->phone = $user->phone ?? '';
        $this->birthDate = $user->birthDate ?? '';

        $this->originalName = $user->name;
        $this->originalEmail = $user->email;
        $this->originalCpf = $user->cpf ?? '';
        $this->originalPhone = $user->phone ?? '';
        $this->originalBirthDate = $user->birthDate ?? '';
    }

    public function setTab(string $tab)
    {
        $this->tab = $tab;
    }

    public function save()
    {
        try {
            $user = Auth::user();

            $validated = $this->validate([
                'name' => 'required|string|max:255',
                //'email' => 'required|email|unique:users,email,' . $user->id,
                'cpf' => 'nullable|string|max:11',
                'phone' => 'nullable|string',
                'birthDate' => 'nullable|date',
                'password' => 'nullable|confirmed|min:5'
            ]);

            if(!empty($validated['password'])){
                $validated['password'] = Hash::make($validated['password']);
            }else{
                unset($validated['password']);
            }

            $user->update($validated);

            $this->originalName = $this->name;
            //$this->originalEmail = $this->email;
            $this->originalCpf = $this->cpf;
            $this->originalPhone = $this->phone;
            $this->originalBirthDate = $this->birthDate;

            session()->flash('success', 'Dados atualizados com sucesso!');

            $this->dispatch('refreshPage');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao atualizar dados. Tente novamente.');
        }
    }

    public function cancel()
    {
        $this->name = $this->originalName;
        //$this->email = $this->originalEmail;
        $this->cpf = $this->originalCpf;
        $this->phone = $this->originalPhone;
        $this->birthDate = $this->originalBirthDate;
        $this->password = '';
        $this->password_confirmation = '';
    }

    public function deleteAccount()
    {
        $user = Auth::user();

        Auth::logout();

        $user->delete();

        session()->invalidate();
        session()->regenerateToken();

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.account-section');
    }
}
