<section class="admin-content">

    <div class="admin-form">
        <h2>Adicionar Novo Prato</h2>
        <form wire:submit.prevent="save" id="prato-form">
            <div class="form-group">
                <label for="nome">Nome do Prato:</label>
                <input wire:model.defer="name" type="text" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea wire:model.defer="description" id="descricao" name="descricao" required></textarea>
            </div>
            <div class="form-group">
                <label for="categoria">Categoria:</label>
                <select wire:model.defer="category_id" id="categoria" name="categoria" required>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="preco">Preço:</label>
                <input wire:model.defer="price" type="number" id="preco" name="preco" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="imagem">URL da Imagem:</label>
                <input wire:model.defer="url_image" type="url" id="imagem" name="imagem">
            </div>
            <button type="submit">Adicionar Prato</button>
        </form>
    </div>

    <div class="admin-lista">
        <h2>Pratos Existentes</h2>
        <ul id="pratos-lista">
            @if (session()->has('message'))
            <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 3000)"
                x-show="show"
                x-transition
                class="alert" style="color: white">
                {{ session('message') }}
            </div>
            @endif @forelse($products as $product)
            <li>
                <span>{{ $product->name }}</span>
                <div class="acoes">
                    <button class="editar"
                        @click="window.location.href='/products/{{ $product->id }}/edit'">
                        Editar</button> |
                    <button class="excluir"
                        @click="if (confirm('Tem certeza que deseja excluir este prato?')) { $wire.delete({{ $product->id }}) }">
                        Excluir
                    </button>
                </div>
            </li>
            @empty
            <li>Nenhum prato cadastrado</li>
            @endforelse
        </ul>
    </div>

</section>
