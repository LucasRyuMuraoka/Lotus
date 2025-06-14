<section class="admpratos-admin-content">

    <div class="admpratos-admin-form">
        <h2>Adicionar Novo Prato</h2>
        <form wire:submit.prevent="save" id="prato-form">
            <div class="admpratos-form-group">
                <label for="nome">Nome do Prato:</label>
                <input wire:model.defer="name" type="text" id="nome" name="nome" required>
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="admpratos-form-group">
                <label for="descricao">Descrição:</label>
                <textarea wire:model.defer="description" id="descricao" name="descricao" required></textarea>
                @error('description') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="admpratos-form-group">
                <label for="categoria">Categoria:</label>
                <select wire:model.defer="category_id" id="categoria" name="categoria" required>
                    <option value="">Selecione uma categoria</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="admpratos-form-group">
                <label for="preco">Preço:</label>
                <input wire:model.defer="price" type="number" id="preco" name="preco" step="0.01" required>
                @error('price') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="admpratos-form-group">
                <label for="imagem">URL da Imagem:</label>
                <input wire:model.defer="url_image" type="url" id="imagem" name="imagem">
                @error('url_image') <span class="error">{{ $message }}</span> @enderror
            </div>
            <button type="submit">Adicionar Prato</button>
        </form>
    </div>

    <div class="admpratos-admin-lista">
        <h2>Pratos Existentes</h2>
        <ul id="admpratos-pratos-lista">
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
                <div class="admpratos-acoes">
                    <button class="admpratos-editar"
                        @click="window.location.href='/products/{{ $product->id }}/edit'">
                        Editar</button> |
                    <button class="admpratos-excluir"
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
