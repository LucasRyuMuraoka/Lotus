<?php

namespace App\Livewire;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddToCartButton extends Component
{

    public $productId;
    public $class;

    public function mount($productId, $class)
    {
        $this->productId = $productId;
        $this->class = $class;
    }

    public function addCart()
    {
        if (Auth::check()) {
            $cart = Cart::firstOrCreate([
                'user_id' => Auth::id(),
                'status' => 'active',
            ]);

            $item = $cart->items()->where('product_id', $this->productId)->first();

            if ($item) {
                $item->increment('quantity');
            } else {
                $cart->items()->create([
                    'product_id' => $this->productId,
                    'quantity' => 1,
                ]);
            }
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$this->productId])) {
                $cart[$this->productId]['quantity']++;
            } else {
                $cart[$this->productId] = [
                    'product_id' => $this->productId,
                    'quantity' => 1,
                ];
            }

            session()->put('cart', $cart);
        }

        $this->dispatch('cart-updated');

        $this->dispatch('cart-added', [
            'message' => 'Produto adicionado',
            'productId' => $this->productId,
        ]);
    }

    public function render()
    {
        return view('livewire.add-to-cart-button');
    }
}
