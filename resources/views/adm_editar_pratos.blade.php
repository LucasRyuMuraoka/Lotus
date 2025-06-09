<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Lotus - Edição de Prato</title>
    <link rel="stylesheet" href="{{ asset('assets/css/normalize/normalize.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/global/global.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/editar-pratos.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="icon" href="{{ Asset('/assets/images/tori-icon.jpg') }}">

    @livewireStyles
</head>

<body>

    @livewire('admin-header')

    <main class="admprato-edit-admin-main">

        <section class="admprato-edit-admin-hero">
            <div class="admprato-edit-hero-content">
                <h1 class="animate__animated animate__fadeInDown">
                    Editar <span>Prato</span>
                </h1>
                <p class="animate__animated animate__fadeIn animate__delay-1s">
                    Altere os dados do prato selecionado.
                </p>
            </div>
        </section>

        <section class="admprato-edit-admin-content">
            <div class="admprato-edit-admin-form">
                <h2>Editando Prato:</h2>
                <form id="editar-prato-form" method="post" action="/products/{{ $product->id }}"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    {{-- <input type="hidden" id="prato-id" name="id" value="{{ $product->id }}" /> --}}

                    <div class="admprato-edit-form-group">
                        <label for="name">Nome do Prato:</label>
                        <input type="text" id="nome-prato" name="name" required value="{{ $product->name }}" />
                        @error('name') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <div class="admprato-edit-form-group">
                        <label for="descricao">Descrição:</label>
                        <textarea id="descricao" name="description" rows="4"
                            required>{{ $product->description }}</textarea>
                        @error('description') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <div class="admprato-edit-form-group">
                        <label for="categoria">Categoria:</label>
                        <select id="categoria" name="category_id" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id === $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <div class="admprato-edit-form-group">
                        <label for="preco">Preço (R$):</label>
                        <input type="number" id="preco" name="price" step="0.01" required
                            value="{{ $product->price }}" />
                        @error('price') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <div class="admprato-edit-form-group">
                        <label for="imagem">URL da Imagem:</label>
                        <input type="url" id="imagem" name="url_image" placeholder="https://..." required
                            value="{{ $product->url_image }}" />
                        @error('url_image') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="admprato-edit-button">Salvar Alterações</button>
                    <a href="{{ route('pratos') }}" class="admprato-btn-cancelar">Cancelar</a>
                </form>
            </div>
        </section>
    </main>

    <div class="pre-footer-line"></div>

    @livewire('admin-footer')

    @livewireScripts
</body>

</html>