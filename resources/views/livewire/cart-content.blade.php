<section class="carrinho-content" id="carrinho-content">

    @if($items->isEmpty())
        <div class="carrinho-vazio" id="carrinho-vazio">
            <img src="{{ asset('assets/images/carrin-vazio.png') }}" alt="Carrinho vazio" class="carrinho-vazio-img" />
            <h2>Seu carrinho está vazio</h2>
            <p>
                Adicione itens do nosso cardápio para continuar.
            </p>
            <a href="{{ route('cardapio') }}" class="carrinho-voltar-btn">Ver Cardápio</a>
        </div>
    @else
        <div class="carrinho-com-itens" id="carrinho-com-itens">

            <div class="carrinho-itens">
                <h2>Itens no Carrinho</h2>

                <div class="carrinho-lista" id="carrinho-lista">

                    @foreach($items as $item)
                        <div class="carrinho-item">
                            <img src="{{ $item->product->url_image }}" alt="{{ $item->product->name }}" class="carrinho-item-img">
                            <div class="carrinho-item-info">
                                <h3>{{ $item->product->name }}</h3>
                                <p>{{ $item->product->description }}</p>
                                <span class="carrinho-item-preco">R$ {{ number_format($item->product->price, 2, ',', '.') }}</span>
                            </div>
                            <div class="carrinho-item-controles">
                                <div class="carrinho-quantidade-controle">
                                    <div class="carrinho-quantidade-btn menos" wire:click="decrement({{ $item->product->id }})">-</div>
                                    <input type="text" class="carrinho-quantidade" value="{{ $item->quantity }}" readonly>
                                    <div class="carrinho-quantidade-btn mais" wire:click="increment({{ $item->product->id }})">+</div>
                                </div>
                                <button class="carrinho-remover-btn" wire:click="removeItem({{ $item->product->id }})"
                                    data-index="0">Remover</button>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

            <div class="carrinho-resumo">
                <h2>Resumo do Pedido</h2>
                <div class="carrinho-resumo-valores">
                    <div class="carrinho-valor-linha">
                        <span>Subtotal:</span>
                        <span id="subtotal">R$ {{ number_format($subtotal, 2, ',', '.') }}</span>
                    </div>
                    <div class="carrinho-valor-linha">
                        <span>Taxa de entrega:</span>
                        <span id="taxa-entrega">R$ {{ number_format($taxaEntrega, 2, ',', '.') }}</span>
                    </div>
                    <div class="carrinho-valor-linha total">
                        <span>Total:</span>
                        <span id="total">R$ {{ number_format($total, 2, ',', '.') }}</span>
                    </div>
                </div>

                <div class="carrinho-entrega-info">
                    <h3>Endereço de Entrega</h3>
                    <div id="entrega-form">
                        <div class="carrinho-form-group">
                            <label for="cep">CEP</label>
                            <input type="text" id="cep" placeholder="00000000" maxlength="8" aria-label="CEP"
                                wire:model="zip_code" />
                        </div>
                        <div class="carrinho-form-row">
                            <div class="carrinho-form-group">
                                <label for="rua">Rua</label>
                                <input type="text" id="rua" placeholder="Rua" aria-label="Rua" wire:model="street" />
                            </div>
                            <div class="carrinho-form-group numero">
                                <label for="numero">Número</label>
                                <input type="text" id="numero" placeholder="Nº" aria-label="Número" wire:model="number" />
                            </div>
                        </div>
                        <div class="carrinho-form-group">
                            <label for="complemento">Complemento</label>
                            <input type="text" id="complemento" placeholder="Apto, Bloco, etc. (opcional)"
                                aria-label="Complemento" wire:model="complement" />
                        </div>
                        <div class="carrinho-form-row">
                            <div class="carrinho-form-group">
                                <label for="bairro">Bairro</label>
                                <input type="text" id="bairro" placeholder="Bairro" aria-label="Bairro"
                                    wire:model="district" />
                            </div>
                            <div class="carrinho-form-group">
                                <label for="cidade">Cidade</label>
                                <input type="text" id="cidade" placeholder="Cidade" aria-label="Cidade" wire:model="city" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carrinho-pagamento">
                    <h3>Forma de Pagamento</h3>
                    <div class="carrinho-pagamento-opcoes">
                        <label class="carrinho-opcao-pagamento">
                            <input type="radio" name="pagamento" value="cartao" checked />
                            <span class="carrinho-radio-custom"></span>
                            <span>Cartão de Crédito</span>
                        </label>
                        <label class="carrinho-opcao-pagamento">
                            <input type="radio" name="pagamento" value="pix" />
                            <span class="carrinho-radio-custom"></span>
                            <span>PIX</span>
                        </label>
                        <label class="carrinho-opcao-pagamento">
                            <input type="radio" name="pagamento" value="dinheiro" />
                            <span class="carrinho-radio-custom"></span>
                            <span>Dinheiro</span>
                        </label>
                    </div>
                </div>

                <button wire:click="finalizarCompra" id="finalizar-compra" class="carrinho-finalizar-btn">
                    Finalizar Pedido
                </button>
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
                                Livewire.dispatch('show-notification', {
                                    message: 'CEP não encontrado!',
                                    type: 'error',
                                    duration: 4000
                                });
                            }
                        })
                        .catch(() => {
                            Livewire.dispatch('show-notification', {
                                message: 'Erro ao buscar o CEP. Tente novamente.',
                                type: 'error',
                                duration: 4000
                            });
                        });
                }
            });
        });
    </script>
@endpush