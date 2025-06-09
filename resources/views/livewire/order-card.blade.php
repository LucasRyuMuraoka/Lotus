<div class="profile-order-card" data-status="{{ $order->status }}">
    <div class="profile-order-header">
        <div class="profile-order-number">
            <h3>Pedido #{{ $order->id }}</h3>
            <span class="profile-order-date">{{ $order->created_at->format('d/m/Y - H:i') }}</span>
        </div>
        <div class="profile-order-status
            {{ $order->status === 'Em entrega' ? 'profile-status-delivery' : '' }}
            {{ $order->status === 'Entregue' ? 'profile-status-delivered' : '' }}
            {{ $order->status === 'Em preparo' ? 'profile-status-preparing' : '' }}
            {{ $order->status === 'Cancelado' ? 'profile-status-canceled' : '' }}
            ">
            <span>{{ $order->status }}</span>
            <div class="profile-status-dot"></div>
        </div>
    </div>

    <div class="profile-order-details">
        <div class="profile-order-items">
            @foreach($order->items as $item)
            <p><strong>{{ $item->quantity }}x</strong>{{ $item->product->name }}</p>
            @endforeach
        </div>

        <div class="profile-order-actions">
            <span class="profile-order-price">R$ {{ number_format($order->total, 2, ',', '.') }}</span>
            @if($order->status !== 'Entregue' && $order->status !== 'Cancelado')
            <button class="profile-order-cancel" @click="if (confirm('Tem certeza que deseja excluir este prato?')) { $wire.cancelOrder() }">Cancelar</button>
            @endif
        </div>
    </div>

    <div class="profile-order-delivery-info">
        <div class="profile-delivery-time">
            <p>Tempo estimado:</p>
            <span>15-20 min</span>
        </div>

        <div class="profile-delivery-address">
            <p>Entrega para:</p>
            <span>{{ $order->street }}, {{ $order->number }}{{ $order->complement ? ', ' . $order->complement : '' }}</span>
        </div>
    </div>

</div>
