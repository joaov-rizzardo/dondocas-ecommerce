<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <script defer src="js/main.js"></script>
</head>

<body>
    <main>

        <section id="principal">
            <img src="<?=$pathBase?>img/teste.jpg" alt="">
        </section>
        <section id="categorias">

            <div class="div-titulo">
                <div class="titulo">
                    <span>  
                        categorias
                    </span>
                </div>
            </div>

            <div id="div-cards">
                <a class="card">
                    <img src="<?=$pathBase?>img/roup.jpg" alt="">
                </a>

                <a class="card">
                    <img src="<?=$pathBase?>img/acces.jpg" alt="">
                </a>

                <a class="card">
                    <img src="<?=$pathBase?>img/calc.jpg" alt="">
                </a>
            </div>
        </section>

        <!-- INICIO DA SESSÃO DE NOVIDADES -->
        <section id="novidades">
            <div class="div-titulo">
                <div class="titulo">
                    <span>
                        novidades
                    </span>
                </div>
            </div>
            <article id="slider-novidades">
                <div class="glide">
                    <div class="glide__track" data-glide-el="track">
                        <ul class="glide__slides">
                            <li class="glide__slide">
                                <a href="https://www.google.com.br" style="display: block;">
                                    <img class="img-novidades" src="<?=$pathBase?>img/novidades.jpg" alt="">
                                    <h2 class="veja-mais">Veja mais</h2>
                                </a>
                                <div>
                                    <span>Macacão listrado</span>
                                    <h6>R$ 51,00</h6>
                                    <small>Até 10x (sem juros)</small>
                                </div>
                            </li>

                        </ul>
                        <div class="glide__arrows" data-glide-el="controls">
                            <button class="glide__arrow glide__arrow--left" data-glide-dir="<"><i class="fa-solid fa-chevron-left"></i></button>
                            <button class="glide__arrow glide__arrow--right" data-glide-dir=">"><i class="fa-solid fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>
            </article>
        </section>
        <!-- FIM DA SESSÃO DE NOVIDADES -->

        <!-- INICIO DA SESSÃO DE PROMOÇÕES -->

        <section id="promocoes">
            <div class="div-titulo">
                <div class="titulo">
                    <span>
                        promoções
                    </span>
                </div>
            </div>

            <article id="slider-promocoes">
                <div class="glide">
                    <div class="glide__track" data-glide-el="track">
                        <ul class="glide__slides">
                            <li class="glide__slide">
                                <a href="https://www.google.com.br" style="display: block;">
                                    <img class="img-novidades" src="<?=$pathBase?>img/novidades.jpg" alt="">
                                    <h2 class="veja-mais">Veja mais</h2>
                                </a>

                                <span>Macacão listrado</span>
                                <h6>R$ 51,00</h6>
                                <small>Até 10x (sem juros)</small>
                            </li>
                        </ul>
                        <div class="glide__arrows" data-glide-el="controls">
                            <button class="glide__arrow glide__arrow--left" data-glide-dir="<"><i class="fa-solid fa-chevron-left"></i></button>
                            <button class="glide__arrow glide__arrow--right" data-glide-dir=">"><i class="fa-solid fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>
            </article>
        </section>

        <!-- FIM DA SESSÃO DE PROMOÇÕES -->

        <!-- INICIO DA SESSÃO DE NEWSLETTER -->

        <section id="newsletter">
            <article>
                <h3><i class="fa-solid fa-envelope"></i></h3>
                <span>newsletter</span>
            </article>

            <div>
                <p>Não perca tempo!</p>
                <p>Cadastre seu email e fique por dentro de todas as novidades na Dondoca's</p>
            </div>

            <article id="input-email">
                <input class="form-control" type="email" name="" id="email" placeholder="Digite o seu email">
                <button class="btn btn-dark">Enviar</button>
            </article>

        </section>

        <!-- FIM DA SESSAO NEWSLETTER -->

        <!-- INICIO DA SESSAO DE CONTATOS -->

        <section id="contato">
            <div class="div-titulo">
                <div class="titulo">
                    <span>
                        onde nos encontrar
                    </span>
                </div>
            </div>

            <div id="div-contato" class="row">
                <div id="contato-text" class="col-md-6">
                    <div class="contato-itens">
                        <i class="fa-solid fa-phone"></i>
                        <span>(12) 99756-7730</span>
                    </div>

                    <div class="contato-itens">
                        <i class="fa-solid fa-location-dot"></i>
                        <span>Jardim da Fonte, Rua São Paulo Nº20, Cachoeira Paulista - SP - Brasil</span>
                    </div>

                    <div class="contato-itens">
                        <i class="fa-solid fa-envelope"></i>
                        <span>dondocas.modafeminina@gmail.com</span>
                    </div>
                </div>

                <div class="col-md-6 d-flex justify-content-center">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3681.952845275617!2d-45.010870385038835!3d-22.655546685140152!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3c85b516655adb25!2zMjLCsDM5JzIwLjAiUyA0NcKwMDAnMzEuMyJX!5e0!3m2!1spt-BR!2sbr!4v1645406613765!5m2!1spt-BR!2sbr" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </section>
    </main>
</body>

</html>