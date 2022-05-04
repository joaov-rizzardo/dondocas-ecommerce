<?php
    require_once '../../vendor/autoload.php';
    require_once '../models/product.php';
    require_once __DIR__."/../services/log.php";
    
    use Gregwar\Image\Image;
    
    $action = $_POST['action'];

    switch ($action) {
        // INSERE E ATUALIZA AS INFORMAÇÕES DE PRODUTO
        case 'saveProduct':
            try {
                $imageName = '';

                if(isset($_FILES['image']['tmp_name']) && !empty($_FILES['image']['tmp_name'])){
                    // OBTENDO DADOS REFERENTES A IMAGEM
                    $imageX = $_POST['imageX'];
                    $imageY = $_POST['imageY'];
                    $imageWidth = $_POST['imageWidth'];
                    $imageHeight = $_POST['imageHeight'];

                    // GERANDO NOME ÚNICO PARA IMAGEM QUE SERÁ SALVA
                    $imageName = 'img'.date('dmYHis').'.jpg';

                    // REALIZANDO O CROP DA IMAGEM E UPLOAD PARA A PASTA IMAGE                
                    Image::open($_FILES['image']['tmp_name'])
                            ->crop($imageX, $imageY, $imageWidth, $imageHeight)
                            ->save("../../img/{$imageName}");
                }
                
                
                // ARRAY QUE DEVE CONTER OS ATRIBUTOS DA CLASSE QUE SERÁ INSTANCIADA
                // OS INDICES DEVEM SER IGUAIS AO NOME DO ATRIBUTO
                $productData = [
                    'product_name' => $_POST['product_name'],
                    'product_value' => str_replace(',', '.', $_POST['product_value']),
                    'category_key' => $_POST['category_key'],
                    'subcategory_key' => $_POST['subcategory_key'],
                    'product_promotion' => $_POST['product_promotion'],
                    'product_promotion_value' => str_replace(',', '.', $_POST['product_promotion_value']),
                    'stock' => json_decode($_POST['stock'], true)   
                ];

                if(!empty($imageName)){
                    $productData['product_photo'] = $imageName;
                }

                // SÓ IRÁ EXISTIR PRODUCT_KEY QUANDO FOR UM UPDATE
                if(isset($_POST['product_key'])){
                    $productData['product_key'] = $_POST['product_key'];
                }

                $product = new Product();
                $product->handleCreateProduct($productData);
                $response = $product->saveProduct();
                
                echo $response;
                
            }catch (Exception $e) {
                echo $e->getMessage();
            }
            
        break;
        //OBTEM AS SUBCATEGORIAS COM BASE NO CÓDIGO DE CATEGORIA INFORMADO
        case 'getSubcategories':
            $category_key = $_POST['category_key'];

            $product = new Product();

            $subCategories = $product->getSubCategories($category_key);

            echo json_encode($subCategories);
        break;
        // OBTEM OS TAMANHOS COM BASE NA SUBCATEGORIA INFORMADA
        case 'getCategorySizes':
            $category_key = $_POST['category_key'];

            $product = new Product();

            $sizes = $product->getCategorySizes($category_key);

            echo json_encode($sizes);
        break;
        // DELETA A LINHA DE ESTOQUE INFORMADA
        case 'delStock':
            $stock_key = $_POST['stock_key'];

            if(empty($stock_key)){
                echo false;
                return;
            }

            $product = new Product();

            $product->delStockLine($stock_key);
            
        break;

        case 'delProduct':
            $product_key = $_POST['productKey'];

            Log::writelog('product_key', $product_key);
            if(empty($product_key)){
                echo false;
                return;
            }

            $product = new Product();

            $product->delProduct($product_key);

        break;
    }
?>