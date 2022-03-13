<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CROPPER -->
    <script src="<?=$pathBase?>node_modules/cropperjs/dist/cropper.js"></script>
    <link rel="stylesheet" href="<?=$pathBase?>node_modules/cropperjs/dist/cropper.css">
    
    <link rel="stylesheet" href="<?=$pathBase?>css/cadastroProdutos.css">
    <script defer src="<?=$pathBase?>js/cadastroProdutos.js"></script>
</head>

<body>
    <main>
        <h2>Cadastro de Produto</h2>

        <section class="row" id="register">
            <article class="col-md-6">
                <div class="item">
                    <label>Nome:</label>
                    <input type="text" class="form-control">
                </div>

                <div class="item">
                    <label>Valor:</label>
                    <input type="text" class="form-control">
                </div>

                <div class="item">
                    <label>Cor:</label>
                    <input type="text" class="form-control">
                </div>
                
            </article>

            <article class="col-md-6">
                <div class="item">
                    <label>Categoria:</label>
                    <select name="" id="" class="form-control">
                        <option value="">Selecione uma categoria</option>
                    </select>
                </div>

                <div class="item">
                    <label>Subcategoria:</label>
                    <select name="" id="" class="form-control">
                        <option value="">Selecione uma subcategoria</option>
                    </select>
                </div>

                <div class="item">
                    <label>Foto:</label>
                    <input class="form-control" type="file" id="img-file">
                </div>
            </article>

            <button class="btn btn-primary" id="save">Salvar alterações</button>
        </section>

        <!-- MODAL PARA CROP DAS IMAGENS -->

        <div class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-body d-flex justify-content-center">
                    <img id="img-modal" src="<?=$pathBase?>img/novidades.jpg" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="save-img">Salvar</button>
                </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>