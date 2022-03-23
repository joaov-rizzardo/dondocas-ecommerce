<?php
    require_once __DIR__."/../models/product.php";

    $productArray = Array();
    
    if(isset($_GET['product_key']) && !empty($_GET['product_key'])){

        $product_key = $_GET['product_key'];

        $product = new Product($product_key);
        
        // RECUPERA OS ATRIBUTOS DO PRODUTO EM FORMATO DE ARRAY
        $productArray = $product->getObjectVars();
        
    }else{
        $product = new Product();
    }


    $categories = $product->getCategories();
    $subcategories = $product->getSubcategories($product->__get('category_key'));
    $sizes = $product->getSubcategorySizes($product->__get('subcategory_key'));
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- pathBase para ser usado pelos arquivos JS -->
    <script defer>
        const pathBase = '<?=$pathBase?>'
    </script>

    <!-- CROPPER -->
    <script src="<?=$pathBase?>node_modules/cropperjs/dist/cropper.js"></script>
    <link rel="stylesheet" href="<?=$pathBase?>node_modules/cropperjs/dist/cropper.css">

    <!-- JQUERY MASK -->
    <script src="<?=$pathBase?>node_modules/jquery-mask-plugin/dist/jquery.mask.min.js"></script>

    <!-- AXIOS -->
    <script src="<?=$pathBase?>node_modules/axios/dist/axios.js"></script>

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
                    <input type="text" class="form-control" id="product-name" value="<?=$productArray['product_name']?>">
                </div>

                <div class="item">
                    <label>Valor:</label>
                    <input type="text" 
                           class="form-control" 
                           id="product-value" 
                           placeholder="0000,00" 
                           value="<?=$productArray['product_value']?>">
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
                        <?php foreach($categories as $category){ ?>
                            
                            <!-- SETA A CATEGORIA COMO SELECIONADA SE É A QUE ESTÁ GRAVADA NO PRODUTO -->
                            <option  <?php if($category['category_key'] == $productArray['category_key']) echo "selected";?>  value="<?=$category['category_key']?>">
                                <?=$category['category_name']?>
                            </option>

                        <?php } ?>
                    </select>
                </div>

                <div class="item">
                    <label>Subcategoria:</label>
                    <select id="product-subcategory" class="form-control">
                        <!-- SETA A SUBCATEGORIA COMO SELECIONADA SE É A QUE ESTÁ GRAVADA NO PRODUTO -->
                        <?php foreach($subcategories as $subcategory){ ?>
                            <option <?php if($productArray['subcategory_key'] == $subcategory['subcategory_key']) echo "selected"; ?>  value="<?=$subcategory['subcategory_key']?>">
                                <?=$subcategory['subcategory_name']?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </article>
        </section>

        <h2>Informações de Estoque <button id="stock_add"><i class="fa-solid fa-circle-plus"></i></button></h2>
        
        <!-- OS ELEMENTOS SERÃO INSERIDOS COM JS OU PHP -->
        <section id="stock-information">
            <!-- INICIO DO FOREACH -->
            <?php foreach($productArray['stock'] as $stock) { ?>
                <fieldset class="fieldset-stock-item">
                    <div class="stock-item">
                        <label>Cor:</label>
                        <input type="text" class="form-control product-color-name" value="<?=$stock['product_color_name']?>">

                        <label>Selecione a cor:</label>
                        <input type="color" class="form-control product-color">
                    </div>

                    <div class="stock-item">
                        <label>Tamanho:</label>
                        <select class="form-control product-size">
                            <?php foreach($sizes as $size) { ?>
                                <!-- SETA O TAMANHO COMO SELECIONADO SE É O QUE ESTÁ GRAVADO NO PRODUTO -->
                                <option <?php if($stock['size_key'] == $size['size_key']) echo "selected"; ?> value="<?=$size['size_key']?>">
                                    <?=$size['size_name']?>
                                </option>
                            <?php } ?>   
                        </select>

                        <label>Quantidade:</label>
                        <input type="text" class="form-control product-size" value="<?=$stock['product_amount']?>">
                    </div>
                </fieldset>

            <?php } ?>
            <!-- FIM DO FOREACH -->
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