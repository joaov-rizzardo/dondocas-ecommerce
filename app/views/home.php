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
                    <img src="img/roupas.jpg" alt="">
                </a>

                <a class="card">
                    <img src="img/acessorios.jpg" alt="">
                </a>

                <a class="card">
                    <img src="img/calcados.jpg" alt="">
                </a>
            </div>
        </section>

        <section id="novidades">
            <div class="div-titulo">
                <div class="titulo">
                    <span>
                        novidades
                    </span>
                </div>
            </div>
            <article style="margin-top: 40px;" id="slider-novidades">
                <div class="glide">
                    <div class="glide__track" data-glide-el="track">
                        <ul class="glide__slides">
                            <li class="glide__slide">
                                <a href="" style="display: block;">
                                    <img src="img/novidades.jpg" alt="">
                                </a>
                                <h3>R$ 51,00</h3>
                                <small>Até 10x (sem juros)</small>
                            </li>

                        </ul>
                        <div class="glide__arrows" data-glide-el="controls">
                            <button class="glide__arrow glide__arrow--left" data-glide-dir="<"><i class="fa-solid fa-angle-left"></i></button>
                            <button class="glide__arrow glide__arrow--right" data-glide-dir=">"><i class="fa-solid fa-angle-right"></i></button>
                        </div>
                    </div>
                </div>
            </article>

        </section>
    </main>
</body>

</html>