<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginForm extends Component
{

    public string $email = '';
    public string $password = '';

    public function login()
    {
        $guestCart = session()->get('cart', []);

        try {
            $credentials = $this->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::attempt($credentials)) {
                session()->regenerate();

                $user = Auth::user();

                $this->mergeCart($guestCart, $user);

                session()->forget('cart');

                $this->dispatch('show-notification', [
                    'message' => 'Login realizado com sucesso! Redirecionando...',
                    'type' => 'success',
                    'duration' => 3000
                ]);

                $redirectUrl = $user->role === 'admin' ? '/dashboard' : '/cardapio';
                $this->js('setTimeout(() => { window.location.href = "' . $redirectUrl . '"; }, 2000);');

                return;
            }

            $this->dispatch('show-notification', [
                'message' => 'E-mail ou senha incorretos.',
                'type' => 'error',
                'duration' => 5000
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            $errorMessage = 'Preencha todos os campos corretamente: ' . implode(', ', $errors);
            
            $this->dispatch('show-notification', [
                'message' => $errorMessage,
                'type' => 'error',
                'duration' => 5000
            ]);
        } catch (\Exception $e) {
            $this->dispatch('show-notification', [
                'message' => 'Erro interno. Tente novamente.',
                'type' => 'error',
                'duration' => 5000
            ]);
        }
    }

    protected function mergeCart($guestCart, User $user)
    {
        $cart = Cart::firstOrCreate(
            ['user_id' => $user->id, 'status' => 'active'],
            ['status' => 'active']
        );

        foreach ($guestCart as $productId => $item) {
            $existing = $cart->items()->where('product_id', $productId)->first();

            if ($existing) {
                $existing->quantity += $item['quantity'];
                $existing->save();
            } else {
                $cart->items()->create([
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                ]);
            }
        }
    }

    public function render()
    {
        return view('livewire.login-form');
    }
}