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
                $this->dispatch('show-notification', ['message' => 'Quantidade atualizada!', 'type' => 'success', 'duration' => 3000]);
            }
            $this->refreshCart();
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$productId])) {
                $cart[$productId]['quantity']++;
                $this->dispatch('show-notification', ['message' => 'Quantidade atualizada!', 'type' => 'success', 'duration' => 3000]);
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
                    $this->dispatch('show-notification', ['message' => 'Quantidade atualizada!', 'type' => 'success', 'duration' => 3000]);
                } else {
                    $item->delete();
                    $this->dispatch('show-notification', ['message' => 'Item removido do carrinho!', 'type' => 'success', 'duration' => 3000]);
                }
            }

            $this->refreshCart();
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$productId])) {
                if ($cart[$productId]['quantity'] > 1) {
                    $cart[$productId]['quantity']--;
                    $this->dispatch('show-notification', ['message' => 'Quantidade atualizada!', 'type' => 'success', 'duration' => 3000]);
                } else {
                    unset($cart[$productId]);
                    $this->dispatch('show-notification', ['message' => 'Item removido do carrinho!', 'type' => 'success', 'duration' => 3000]);
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
            $this->dispatch('show-notification', ['message' => 'Item removido do carrinho!', 'type' => 'success', 'duration' => 3000]);
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$productId])) {
                unset($cart[$productId]);
                session()->put('cart', $cart);
                $this->cart = collect($cart);
                $this->dispatch('show-notification', ['message' => 'Item removido do carrinho!', 'type' => 'success', 'duration' => 3000]);
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
            $this->dispatch('show-notification', [
                'message' => 'Você precisa estar logado para finalizar a compra.',
                'type' => 'error',
                'duration' => 5000
            ]);
            return;
        }

        if ($this->cart->items->isEmpty()) {
            $this->dispatch('show-notification', [
                'message' => 'Seu carrinho está vazio.',
                'type' => 'error',
                'duration' => 5000
            ]);
            return;
        }

        try {
            $this->validate([
                'zip_code' => 'required',
                'street' => 'required',
                'number' => 'required',
                'district' => 'required',
                'city' => 'required',
            ], [
                'zip_code.required' => 'O CEP é obrigatório.',
                'street.required' => 'A rua é obrigatória.',
                'number.required' => 'O número é obrigatório.',
                'district.required' => 'O bairro é obrigatório.',
                'city.required' => 'A cidade é obrigatória.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            $errorMessage = 'Preencha todos os campos obrigatórios: ' . implode(', ', $errors);
            
            $this->dispatch('show-notification', [
                'message' => $errorMessage,
                'type' => 'error',
                'duration' => 6000
            ]);
            return;
        }

        try {
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
            
            $this->dispatch('show-notification', [
                'message' => 'Pedido finalizado com sucesso! Redirecionando...',
                'type' => 'success',
                'duration' => 3000
            ]);

            // Delay no redirect para mostrar a notificação
            $this->js('setTimeout(() => { window.location.href = "' . route('conta', ['tab' => 'pedidos']) . '"; }, 2000);');

        } catch (\Exception $e) {
            $this->dispatch('show-notification', [
                'message' => 'Erro ao finalizar pedido. Tente novamente.',
                'type' => 'error',
                'duration' => 5000
            ]);
        }
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