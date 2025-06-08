<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrderSection extends Component
{

    public string $status = 'todos';

    public function render()
    {
        $statuses = Order::where('user_id',Auth::id())->select('status')->distinct()->pluck('status');

        $query = Order::where('user_id', Auth::id());

        if ($this->status !== 'todos') {
            $query->where('status', $this->status);
        }

        $orders = $query->with('items.product')->latest()->get();

        return view('livewire.order-section', [
            'orders' => $orders,
            'statuses' => $statuses,
        ]);
    }
}
