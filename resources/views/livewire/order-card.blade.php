<div class="order-card" data-status="{{ $order->status }}">
    <div class="order-header">
        <div class="order-number">
            <h3>Pedido #{{ $order->id }}</h3>
            <span class="order-date">{{ $order->created_at->format('d/m/Y - H:i') }}</span>
        </div>
        <div class="order-status status-delivery">
            <span>{{ $order->status }}</span>
            <div class="status-dot"></div>
        </div>
    </div>

    <div class="order-details">
        <div class="order-items">
            @foreach($order->items as $item)
            <p><strong>{{ $item->quantity }}x</strong>{{ $item->product->name }}</p>
            @endforeach
        </div>

        <div class="order-actions">
            <span class="order-price">R$ {{ number_format($order->total, 2, ',', '.') }}</span>
            <button class="order-track">Rastrear</button>
        </div>
    </div>

    <div class="order-delivery-info">
        <div class="delivery-time">
            <p>Tempo estimado:</p>
            <span>15-20 min</span>
        </div>

        <div class="delivery-address">
            <p>Entrega para:</p>
            <span>{{ $order->street }}, {{ $order->number }}{{ $order->complement ? ', ' . $order->complement : '' }}</span>
        </div>
    </div>

</div>
