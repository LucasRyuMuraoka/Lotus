<div class="profile-account-tab-content active" id="pedidos">

    <div class="profile-orders-header">
        <h2>Histórico de Pedidos</h2>
        <div class="profile-orders-filter">
            <label for="profile-filter-status">Filtrar por status:</label>
            <select id="profile-filter-status" wire:model.change="status">
                <option value="todos">Todos</option>
                @foreach($statuses as $status)
                <option value="{{ $status }}">{{ $status }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="profile-orders-list">

        @foreach ($orders as $order)
        <livewire:order-card :order="$order" :wire:key="'order-' . $order->id" />
        @endforeach

    </div>
</div>
