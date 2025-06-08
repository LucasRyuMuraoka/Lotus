<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrderCard extends Component
{

    public Order $order;

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    public function cancelOrder()
    {
        if ($this->order->status === 'Entregue' || $this->order->status === 'Cancelado') {
            return;
        }

        $this->order->update(['status' => 'Cancelado']);
        $this->order->refresh();

        session()->flash('message', 'Pedido cancelado com sucesso.');
    }

    public function render()
    {
        return view('livewire.order-card');
    }
}
