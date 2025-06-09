<div class="product-actions">
    <div class="product-quantity-selector">
        <button wire:click="decrement" id="decreaseQuantity" class="product-quantity-btn">−</button>
        <span id="product-quantityValue">{{ $quantity }}</span>
        <button wire:click="increment" id="increaseQuantity" class="product-quantity-btn">+</button>
    </div>

    {{-- <livewire:add-to-cart-button :productId="$product->id" class="add-to-cart-btn" /> --}}

    <button wire:click="addCart" class="product-add-to-cart-btn">Adicionar</button>
</div>
