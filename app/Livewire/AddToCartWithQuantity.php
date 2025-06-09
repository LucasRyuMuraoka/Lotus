<?php

namespace App\Livewire;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddToCartWithQuantity extends Component
{

    public $productId;
    public $quantity;

    protected $rules = [
        'quantity' => 'required|integer|min:1'
    ];

    public function mount()
    {
        $this->quantity = 1;
    }

    public function increment()
    {
        $this->quantity++;
    }

    public function decrement()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
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
                $item->increment('quantity',$this->quantity);
            } else {
                $cart->items()->create([
                    'product_id' => $this->productId,
                    'quantity' => $this->quantity,
                ]);
            }
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$this->productId])) {
                $cart[$this->productId]['quantity']+= $this->quantity;
            } else {
                $cart[$this->productId] = [
                    'product_id' => $this->productId,
                    'quantity' => $this->quantity,
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
        return view('livewire.add-to-cart-with-quantity');
    }
}
