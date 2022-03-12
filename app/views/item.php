<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=$pathBase?>css/item.css">
    <!--<script defer src="js/main.js"></script>-->
</head>

<body>
    <main>
        <section id="product" class="row">
            <article class="col-md-8 col-lg-6" id="images">
                <div id="list-images">
                    <div class="list-image-border">
                        <img src="<?=$pathBase?>img/novidades.jpg" alt="">
                    </div>

                    <div>
                        <img src="<?=$pathBase?>img/novidades.jpg" alt="">
                    </div>

                    <div>
                        <img src="<?=$pathBase?>img/novidades.jpg" alt="">
                    </div>
                    
                </div>

                <div id="selected-image">
                    <img src="<?=$pathBase?>img/novidades.jpg" alt="">
                </div>
            </article>

            <article class="col-md-4 col-lg-6" id="information">
                <h2>Macacão Listrado</h2>
                <span id="price">R$59,00</span>
                <select class="form-control" name="size" id="size">
                    <option value="">Selecione o tamanho</option>
                    <option value="">G</option>
                    <option value="">Tamanho único</option>
                </select>
                <button class="btn btn-dark" id="buy">Comprar</button>
                <button class="btn btn-outline-dark" id="add-car">Adicionar ao carrinho</button>
                
                <div id="cep-area">
                    <span>Informe seu CEP para simular os prazos de entrega</span>
                    <div>
                        <input type="text" id="cep">
                        <button class="btn btn-dark" id="calc-cep">Calcular</button>
                    </div>
                </div>

            </article>
        </section>
    </main>
</body>

</html>