<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartContent extends Component
{

    protected $listeners = ['cart-updated' => 'refreshCart'];

    public $cart;
    public float $taxaEntrega = 15;

    public $zip_code;
    public $street;
    public $number;
    public $complement;
    public $district;
    public $city;

    public function mount()
    {

        if (Auth::check()) {
            $this->cart = Cart::with('items.product')
                ->where('user_id', Auth::id())
                ->where('status', 'active')
                ->firstOrCreate(['user_id' => Auth::id(), 'status' => 'active']);

            $this->refreshCart();
        } else {
            $this->cart = collect(session()->get('cart', []));
        }
    }

    public function increment($productId)
    {
        if (Auth::check()) {
            $item = $this->cart->items()->where('product_id', $productId)->first();
            if ($item) {
                $item->increment('quantity');
            }
            $this->refreshCart();
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$productId])) {
                $cart[$productId]['quantity']++;
            }
            session()->put('cart', $cart);
            $this->cart = collect($cart);
        }
    }

    public function decrement($productId)
    {
        if (Auth::check()) {
            $item = $this->cart->items()->where('product_id', $productId)->first();

            if ($item) {
                if ($item->quantity > 1) {
                    $item->decrement('quantity');
                } else {
                    $item->delete();
                }
            }

            $this->refreshCart();
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$productId])) {
                if ($cart[$productId]['quantity'] > 1) {
                    $cart[$productId]['quantity']--;
                } else {
                    unset($cart[$productId]);
                }
            }

            session()->put('cart', $cart);
            $this->cart = collect($cart);
        }
    }

    public function removeItem($productId)
    {
        if (Auth::check()) {
            $this->cart->items()->where('product_id', $productId)->delete();
            $this->refreshCart();
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$productId])) {
                unset($cart[$productId]);
                session()->put('cart', $cart);
                $this->cart = collect($cart);
            }
        }
    }

    public function refreshCart()
    {
        $this->cart->load('items.product');
    }

    public function finalizarCompra()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Você precisa estar logado para finalizar a compra.');
            return;
        }

        if ($this->cart->items->isEmpty()) {
            session()->flash('error', 'Seu carrinho está vazio.');
            return;
        }

        $this->validate([
            'zip_code' => 'required',
            'street' => 'required',
            'number' => 'required',
            'district' => 'required',
            'city' => 'required',
        ]);

        $subtotal = $this->cart->items->sum(fn($item) => $item->product->price * $item->quantity);
        $total = $subtotal + $this->taxaEntrega;

        $order = Order::create([
            'user_id' => Auth::id(),
            'zip_code' => $this->zip_code,
            'street' => $this->street,
            'number' => $this->number,
            'complement' => $this->complement,
            'district' => $this->district,
            'city' => $this->city,
            'status' => 'Em preparo',
            'total' => $total,
        ]);

        foreach ($this->cart->items as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        $this->cart->status = 'completed';
        $this->cart->save();

        $this->cart = Cart::create([
            'user_id' => Auth::id(),
            'status' => 'active',
        ]);

        $this->reset([
            'zip_code',
            'street',
            'number',
            'complement',
            'district',
            'city',
        ]);

        $this->dispatch('cart-updated');
        session()->flash('success', 'Pedido finalizado com sucesso!');

        return redirect()->to(route('conta', ['tab' => 'pedidos']));
    }

    public function render()
    {
        if (Auth::check()) {
            $items = $this->cart->items ?? collect();
        } else {
            $sessionCart = session()->get('cart', []);
            $productIds = collect($sessionCart)->pluck('product_id')->all();
            $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

            $items = collect($sessionCart)->map(function ($item, $key) use ($products) {
                $product = $products[$item['product_id']] ?? null;

                if (!$product) {
                    return null;
                }

                return (object)[
                    'id' => $item['product_id'],
                    'product' => $product,
                    'quantity' => $item['quantity'],
                ];
            })->filter();
        }

        $subtotal = $items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $total = $subtotal + $this->taxaEntrega;

        return view('livewire.cart-content', [
            'items' => $items,
            'subtotal' => $subtotal,
            'taxaEntrega' => $this->taxaEntrega,
            'total' => $total,
        ]);
    }
}
