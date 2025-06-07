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

        $credentials = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            session()->regenerate();

            $user = Auth::user();

            $this->mergeCart($guestCart, $user);

            session()->forget('cart');

            return redirect()->to($user->role === 'admin' ? '/dashboard' : '/cardapio');
        }

        $this->addError('email', 'E-mail ou senha incorretos.');
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
