<section class="carrinho-content" id="carrinho-content">

    @if($items->isEmpty())
        <div class="carrinho-vazio" id="carrinho-vazio">
            <img src="{{ asset('assets/images/carrin-vazio.png') }}" alt="Carrinho vazio" class="vazio-img" />
            <h2>Seu carrinho está vazio</h2>
            <p>
                Adicione itens do nosso cardápio para continuar.
            </p>
            <a href="{{ route('cardapio') }}" class="voltar-btn">Ver Cardápio</a>
        </div>
    @else
        <div class="carrinho-com-itens" id="carrinho-com-itens">

            <div class="carrinho-itens">
                <h2>Itens no Carrinho</h2>

                <div class="carrinho-lista" id="carrinho-lista">

                    @foreach($items as $item)
                        <div class="carrinho-item">
                            <img src="{{ $item->product->url_image }}" alt="{{ $item->product->name }}" class="item-img">
                            <div class="item-info">
                                <h3>{{ $item->product->name }}</h3>
                                <p>{{ $item->product->description }}</p>
                                <span class="item-preco">R$ {{ number_format($item->product->price, 2, ',', '.') }}</span>
                            </div>
                            <div class="item-controles">
                                <div class="quantidade-controle">
                                    <div class="quantidade-btn menos" wire:click="decrement({{ $item->product->id }})">-</div>
                                    <input type="text" class="quantidade" value="{{ $item->quantity }}" readonly>
                                    <div class="quantidade-btn mais" wire:click="increment({{ $item->product->id }})">+</div>
                                </div>
                                <button class="remover-btn" wire:click="removeItem({{ $item->product->id }})"
                                    data-index="0">Remover</button>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

            <div class="carrinho-resumo">
                <h2>Resumo do Pedido</h2>
                <div class="resumo-valores">
                    <div class="valor-linha">
                        <span>Subtotal:</span>
                        <span id="subtotal">R$ {{ number_format($subtotal, 2, ',', '.') }}</span>
                    </div>
                    <div class="valor-linha">
                        <span>Taxa de entrega:</span>
                        <span id="taxa-entrega">R$ {{ number_format($taxaEntrega, 2, ',', '.') }}</span>
                    </div>
                    <div class="valor-linha total">
                        <span>Total:</span>
                        <span id="total">R$ {{ number_format($total, 2, ',', '.') }}</span>
                    </div>
                </div>

                <div class="entrega-info">
                    <h3>Endereço de Entrega</h3>
                    <div id="entrega-form">
                        <div class="form-group">
                            <label for="cep">CEP</label>
                            <input type="text" id="cep" placeholder="00000000" maxlength="8" aria-label="CEP"
                                wire:model="zip_code" />
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="rua">Rua</label>
                                <input type="text" id="rua" placeholder="Rua" aria-label="Rua" wire:model="street" />
                            </div>
                            <div class="form-group numero">
                                <label for="numero">Número</label>
                                <input type="text" id="numero" placeholder="Nº" aria-label="Número" wire:model="number" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="complemento">Complemento</label>
                            <input type="text" id="complemento" placeholder="Apto, Bloco, etc. (opcional)"
                                aria-label="Complemento" wire:model="complement" />
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="bairro">Bairro</label>
                                <input type="text" id="bairro" placeholder="Bairro" aria-label="Bairro"
                                    wire:model="district" />
                            </div>
                            <div class="form-group">
                                <label for="cidade">Cidade</label>
                                <input type="text" id="cidade" placeholder="Cidade" aria-label="Cidade" wire:model="city" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pagamento">
                    <h3>Forma de Pagamento</h3>
                    <div class="pagamento-opcoes">
                        <label class="opcao-pagamento">
                            <input type="radio" name="pagamento" value="cartao" checked />
                            <span class="radio-custom"></span>
                            <span>Cartão de Crédito</span>
                        </label>
                        <label class="opcao-pagamento">
                            <input type="radio" name="pagamento" value="pix" />
                            <span class="radio-custom"></span>
                            <span>PIX</span>
                        </label>
                        <label class="opcao-pagamento">
                            <input type="radio" name="pagamento" value="dinheiro" />
                            <span class="radio-custom"></span>
                            <span>Dinheiro</span>
                        </label>
                    </div>
                </div>

                <button wire:click="finalizarCompra" id="finalizar-compra" class="finalizar-btn">
                    Finalizar Pedido
                </button>

                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif
            </div>

        </div>
    @endif
</section>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cepInput = document.getElementById('cep');

            cepInput.addEventListener('blur', function () {
                const cep = cepInput.value.replace(/\D/g, '');

                if (cep.length === 8) {
                    fetch(`https://viacep.com.br/ws/${cep}/json/`)
                        .then(response => response.json())
                        .then(data => {
                            if (!data.erro) {
                                @this.set('street', data.logradouro || '');
                                @this.set('district', data.bairro || '');
                                @this.set('city', data.localidade || '');
                            } else {
                                alert('CEP não encontrado!');
                            }
                        })
                        .catch(() => {
                            alert('Erro ao buscar o CEP.');
                        });
                }
            });
        });
    </script>
@endpush