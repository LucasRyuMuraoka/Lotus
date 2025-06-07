<div class="menu-item {{ $category }}">
    <div class="menu-img">
        <a href="{{ route('product', ['product' => $productId]) }}">
            <img
                src="{{ $url_image }}"
                alt="{{ $name }}">
        </a>
    </div>
    <div class="menu-info">
        <h3>{{ $name }}</h3>
        <p class="menu-description">{{ $description }}</p>
        <div class="menu-footer">
            <span class="menu-price">R$ {{ number_format($price, 2, ",", ".") }}</span>

            <livewire:add-to-cart-button :productId="$productId" class="menu-add" />

            <div x-data="{ show: false, message: '' }"
                x-show="show"
                x-transition
                x-init="
                    window.addEventListener('cart-added', e => {
                        console.log('Evento recebido: ', e.detail[0].productId);
                        if(e.detail[0].productId ===  @js($productId)){
                            message = e.detail[0].message;
                            show = true;
                            setTimeout(() => show = false, 3000);
                        }
                    })
                "
                class="cart-notification"
                style="display: none;">
                <span x-text="message"></span>
            </div>
        </div>
    </div>
</div>
