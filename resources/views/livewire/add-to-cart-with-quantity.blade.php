<div class="product-actions">
    <div class="quantity-selector">
        <button wire:click="decrement" id="decreaseQuantity" class="quantity-btn">−</button>
        <span id="quantityValue">{{ $quantity }}</span>
        <button wire:click="increment" id="increaseQuantity" class="quantity-btn">+</button>
    </div>

    {{-- <livewire:add-to-cart-button :productId="$product->id" class="add-to-cart-btn" /> --}}

    <button wire:click="addCart" class="add-to-cart-btn">Adicionar</button>
</div>
