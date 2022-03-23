<?php
    require_once '../../vendor/autoload.php';
    require_once '../models/product.php';
    
    use Gregwar\Image\Image;
    
    $action = $_POST['action'];

    switch ($action) {
        // INSERE E ATUALIZA AS INFORMAÇÕES DE PRODUTO
        case 'saveProduct':
            // OBTENDO DADOS REFERENTES A IMAGEM
            $imageX = $_POST['imageX'];
            $imageY = $_POST['imageY'];
            $imageWidth = $_POST['imageWidth'];
            $imageHeight = $_POST['imageHeight'];

            try {
                $imageName = 'img'.date('dmYHis');

                // REALIZANDO O CROP DA IMAGEM E UPLOAD PARA A PASTA IMAGE                
                Image::open($_FILES['image']['tmp_name'])
                        ->crop($imageX, $imageY, $imageWidth, $imageHeight)
                        ->save("../../img/{$imageName}.jpg");
                    
                // ARRAY QUE DEVE CONTER OS ATRIBUTOS DA CLASSE QUE SERÁ INSTANCIADA
                // OS INDICES DEVEM SER IGUAIS AO NOME DO ATRIBUTO
                $productData = [
                    'product_name' => $_POST['product_name'],
                    'product_value' => str_replace(',', '.', $_POST['product_value']),
                    'product_photo' => $imageName,
                    'category_key' => $_POST['category_key'],
                    'subcategory_key' => $_POST['subcategory_key'],
                    'stock' => json_decode($_POST['stock'], true)
                ];

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
        case 'getSubcategorySizes':
            $subcategory_key = $_POST['subcategory_key'];

            $product = new Product();

            $sizes = $product->getSubcategorySizes($subcategory_key);

            echo json_encode($sizes);
        break;
    }
?>