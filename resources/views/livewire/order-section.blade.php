<div class="account-tab-content active" id="pedidos">

    <div class="orders-header">
        <h2>Histórico de Pedidos</h2>
        <div class="orders-filter">
            <label for="filter-status">Filtrar por status:</label>
            <select id="filter-status" wire:model.change="status">
                <option value="todos">Todos</option>
                @foreach($statuses as $status)
                <option value="{{ $status }}">{{ $status }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="orders-list">

        @foreach ($orders as $order)
        <livewire:order-card :order="$order" :wire:key="'order-' . $order->id" />
        @endforeach

    </div>
</div>
