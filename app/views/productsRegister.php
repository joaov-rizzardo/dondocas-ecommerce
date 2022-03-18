<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CROPPER -->
    <script src="<?=$pathBase?>node_modules/cropperjs/dist/cropper.js"></script>
    <link rel="stylesheet" href="<?=$pathBase?>node_modules/cropperjs/dist/cropper.css">

    <!-- JQUERY MASK -->
    <script src="<?=$pathBase?>node_modules/jquery-mask-plugin/dist/jquery.mask.min.js"></script>

    <!-- AXIOS -->
    <script src="<?=$pathBase?>node_modules/axios/dist/axios.min.js"></script>

    <link rel="stylesheet" href="<?=$pathBase?>css/productsRegister.css">
    <script defer src="<?=$pathBase?>js/productsRegister.js"></script>
</head>

<body>
    <main>
        <h2>Cadastro de Produto</h2>

        <section class="row" id="product-information">
            <article class="col-md-6">
                <div class="item">
                    <label>Nome:</label>
                    <input type="text" class="form-control" id="product-name">
                </div>

                <div class="item">
                    <label>Valor:</label>
                    <input type="text" class="form-control" id="product-value" placeholder="0000,00">
                </div>

                <div class="item">
                    <label>Foto:</label>
                    <input class="form-control" type="file" id="img-file">
                    <input type="hidden" id="img-x">
                    <input type="hidden" id="img-y">
                    <input type="hidden" id="img-width">
                    <input type="hidden" id="img-height">
                </div>
                            
            </article>

            <article class="col-md-6">
                <div class="item">
                    <label>Categoria:</label>
                    <select id="product-category" class="form-control">
                        <option value="">Selecione uma categoria</option>
                    </select>
                </div>

                <div class="item">
                    <label>Subcategoria:</label>
                    <select id="product-subcategory" class="form-control">
                        <option value="">Selecione uma subcategoria</option>
                    </select>
                </div>
            </article>
        </section>

        <h2>Informações de Estoque <button id="stock_add"><i class="fa-solid fa-circle-plus"></i></button></h2>
        
        <!-- OS ELEMENTOS SERÃO INSERIDOS COM JS -->
        <section id="stock-information">
        </section>

        <button class="btn btn-primary" id="save">Salvar alterações</button>

        <!-- MODAL PARA CROP DAS IMAGENS -->
        <div class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-body">
                    <img id="img-modal" src="" alt="">
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