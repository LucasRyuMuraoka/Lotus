<main class="main">

    <section class="m-section01">
        <div class="s01-texts">
            <div class="s01-title">
                <h1 class="animate__animated animate__bounce">Fresco e <span>Saudável</span></h1>
                <h1 class="animate__animated animate__bounce">Comida <span>Deliciosa</span></h1>
            </div>

            <div class="s01-subtitle">
                <p class="animate__animated animate__bounce">Venha nesta jornada do jardim de Lotus, focada em sushi.
                    Compartilhe a história e as origens do sushi, destacando a cultura significante e como ela evoluiu com o
                    passar do tempo.</p>
            </div>
        </div>

        <img src="{{ asset('assets/images/sushi.png') }}" alt="sushi" title="sushi" class="s01-img">
    </section>

    <section class="m-section02">
        <div class="s02-texts">
            <div class="s02-title">
                <h1>Gastronomia</h1>
            </div>

            <div class="s02-subtitle">
                <p>Desfrute do melhor da culinária japonesa sem sair de casa!
                    Nosso delivery leva até você sushis e sashimis preparados com ingredientes frescos e selecionados,
                    garantindo qualidade, sabor e uma experiência única.
                    Peça agora e saboreie a tradição do Japão no conforto do seu lar!</p>
            </div>
        </div>

        <a href="/cardapio.html" class="s02-button">Confira nosso Cardápio</a>

        <!-- Elemento Principal - Envolve todo o Slide -->
        <div class="swiper-container">
            <div class="swiper">
                <!-- Dentro dessa classe colocamos os slides -->
                <div class="swiper-wrapper">
                    <!-- Slide 1 -->
                    <div class="swiper-slide"
                        style="background-image: url(https://img.band.uol.com.br/image/2023/11/01/sushi-104416.png);">
                        <div class="slide-overlay"></div>
                        <div class="slide-content">
                            <h2>Sushi Tradicional</h2>
                            <p>Experimente nossos sushis preparados com ingredientes frescos e técnicas tradicionais japonesas.</p>
                            <a href="#" class="btn">Saiba mais</a>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="swiper-slide"
                        style="background-image: url(https://viverbem.unimed.coop.br/wp-content/uploads/2013/07/479-sushi_e_saudavel.jpg);">
                        <div class="slide-overlay"></div>
                        <div class="slide-content">
                            <h2>Variedades Premium</h2>
                            <p>Delicie-se com nossa seleção premium de combinados e pratos especiais.</p>
                            <a href="#" class="btn">Ver cardápio</a>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="swiper-slide"
                        style="background-image: url(https://media.istockphoto.com/id/1555947107/pt/foto/set-of-sushi-and-maki.jpg?s=612x612&w=0&k=20&c=3KOKojB5TWHBXhtR3Gv1Sic0dUXiqPBeQcA-kt2j5jk=);">
                        <div class="slide-overlay"></div>
                        <div class="slide-content">
                            <h2>Combinados Especiais</h2>
                            <p>Conheça nossos combinados especiais, perfeitos para compartilhar momentos únicos.</p>
                            <a href="#" class="btn">Fazer pedido</a>
                        </div>
                    </div>
                </div>

                <!-- Paginação -->
                <div class="swiper-pagination"></div>
                <!-- Botoes para Navegação -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </section>
</main>
