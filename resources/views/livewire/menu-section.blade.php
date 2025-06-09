<section class="menu-c-section-menu">

    <!-- Barra de Pesquisa -->
    <div class="menu-search-container">
        <input
            type="text"
            wire:model.live="search"
            id="searchInput"
            class="menu-search-input"
            placeholder="Buscar pratos..." />
        <button class="menu-search-btn" type="submit">
            <svg
                width="20"
                height="20"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                    stroke="white"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>
    </div>

    <div class="menu-filter">
        <button class="menu-filter-btn {{ $filter === 'todos' ? 'active' : '' }}" wire:click="setFilter('todos')" {{-- data-filter="todos" --}}>Todos</button>
        <button class="menu-filter-btn {{ $filter === 'recomendados' ? 'active' : '' }}" wire:click="setFilter('recomendados')" {{-- data-filter="sushi" --}}>Recomendados</button>
        <button class="menu-filter-btn {{ $filter === 'sashimi' ? 'active' : '' }}" wire:click="setFilter('sashimi')" {{-- data-filter="sashimi" --}}>Sashimi</button>
        <button class="menu-filter-btn {{ $filter === 'combinados' ? 'active' : '' }}" wire:click="setFilter('combinados')" {{-- data-filter="combinados" --}}>Combinados</button>
        <button class="menu-filter-btn {{ $filter === 'bebidas' ? 'active' : '' }}" wire:click="setFilter('bebidas')" {{-- data-filter="bebidas" --}}>Bebidas</button>
    </div>

    <div class="menu-grid">

        @foreach($items as $item)
        <livewire:menu-item
            :name="$item->name"
            :description="$item->description"
            :price="$item->price"
            :category="$item->category->name"
            :url_image="$item->url_image"
            :productId="$item->id"
            :key="$item->id" />
        @endforeach

    </div>
</section>
