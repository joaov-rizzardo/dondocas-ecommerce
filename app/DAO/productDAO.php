<?php
    require_once __DIR__.'/../services/dbConnection.php'; 

    class ProductDAO{

        // ESPERA UM ARRAY CONTENDO AS INFORMAÇÕE DO PRODUTO A SER INSERIDO
        // SEUS INDICES DEVEM SER IGUAIS AOS NOMES DOS CAMPOS NA TABELA
        protected function insertProduct(Array $product){
            global $db;

            $query = "INSERT INTO 
                        product
                    SET
                        product_name = :product_name,
                        product_value = :product_value,
                        product_photo = :product_photo,
                        category_key = :category_key,
                        subcategory_key = :subcategory_key";
            
            $stmt = $db->prepare($query);
            $stmt->bindParam(':product_name', $product['product_name']);
            $stmt->bindParam(':product_value', $product['product_value']);
            $stmt->bindParam(':product_photo', $product['product_photo']);
            $stmt->bindParam(':category_key', $product['category_key']);
            $stmt->bindParam(':subcategory_key', $product['subcategory_key']);

            if(!$stmt->execute()){
                return false;
            }

            $result = $db->lastInsertId();

            return $result;

        }

        protected function replaceStock(Array $stock, $product_key){
            global $db;
            
            $query = "REPLACE INTO 
                        product_stock
                    SET
                        product_key = :product_key,
                        product_color_name = :product_color_name,
                        size_key = :size_key,
                        product_amount = :product_amount";
            
            $stmt = $db->prepare($query);
            $stmt->bindParam(':product_key', $product_key);
            $stmt->bindParam(':product_color_name', $stock['product_color_name']);
            $stmt->bindParam(':size_key', $stock['size_key']);
            $stmt->bindParam(':product_amount', $stock['product_amount']);

            $result = $stmt->execute();

            return $result;
        }

        public function getCategories(){
            global $db;

            $query = "SELECT
                            category_key,
                            category_name
                        FROM
                            product_category";

            $stmt = $db->query($query);

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }

        // OBTEM AS SUBCATEGORIAS, DEVE RECEBER O CÓDIGO DA CATEGORIA PRINCIPAL
        public function getSubCategories($category_key){

            global $db;

            $query = "SELECT
                            subcategory_key,
                            subcategory_name
                        FROM
                            product_subcategory
                        WHERE
                            category_key = :category_key";
            
            $stmt = $db->prepare($query);
            $stmt->bindValue(':category_key', $category_key);
            $stmt->execute();
            
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(!$result){
                return false;
            }

            return $result;
        }

        // OBTEM OS TAMANHOS, DEVE RECEBER O CÓDIGO DA SUBCATEGORIA
        public function getSubcategorySizes($subcategory_key){
            
            global $db;

            $query = "SELECT
                        size_key,
                        size_name
                    FROM
                        product_size
                    WHERE
                        subcategory_key = :subcategory_key";

            $stmt = $db->prepare($query);
            $stmt->bindValue(':subcategory_key', $subcategory_key);
            $stmt->execute();
            
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(!$result){
                return false;
            }

            return $result;
        }
    }
?>