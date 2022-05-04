<?php
    require_once __DIR__.'/../services/dbConnection.php';
    require_once __DIR__."/../services/log.php";

    class ProductDAO{

        protected function getProduct($product_key){
            global $db;

            $query = "SELECT
                        product_key,
                        product_name,
                        category_key,
                        subcategory_key,
                        product_value,
                        product_photo,
                        product_promotion,
                        product_promotion_value,
                        product_date
                    FROM
                        product
                    WHERE
                        product_key = :product_key";
            
            $stmt = $db->prepare($query);
            $stmt->bindParam(':product_key', $product_key);

            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if($result){
                return $result;
            }

        }

        protected function getProductStock($product_key){
            global $db;

            $query = "SELECT
                        stock_key,
                        product_key,
                        product_color_name,
                        product_color,
                        product_amount,
                        size_key
                    FROM
                        product_stock
                    WHERE product_key = :product_key";

            $stmt = $db->prepare($query);
            $stmt->bindParam(':product_key', $product_key);

            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if($result){
                return $result;
            }
        }

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
                        subcategory_key = :subcategory_key,
                        product_promotion = :product_promotion,
                        product_promotion_value = :product_promotion_value";
            
            $stmt = $db->prepare($query);
            $stmt->bindParam(':product_name', $product['product_name']);
            $stmt->bindParam(':product_value', $product['product_value']);
            $stmt->bindParam(':product_photo', $product['product_photo']);
            $stmt->bindParam(':category_key', $product['category_key']);
            $stmt->bindParam(':subcategory_key', $product['subcategory_key']);
            $stmt->bindParam(':product_promotion', $product['product_promotion']);
            $stmt->bindParam(':product_promotion_value', $product['product_promotion_value']);

            if(!$stmt->execute()){
                return false;
            }

            $result = $db->lastInsertId();

            return $result;

        }

        protected function insertStock(Array $stock, $product_key){
            global $db;
            
            $query = "INSERT INTO 
                        product_stock
                    SET
                        product_key = :product_key,
                        product_color_name = :product_color_name,
                        size_key = :size_key,
                        product_amount = :product_amount,
                        product_color = :product_color";
            
            $stmt = $db->prepare($query);
            $stmt->bindParam(':product_key', $product_key);
            $stmt->bindParam(':product_color_name', $stock['product_color_name']);
            $stmt->bindParam(':size_key', $stock['size_key']);
            $stmt->bindParam(':product_amount', $stock['product_amount']);
            $stmt->bindParam(':product_color', $stock['product_color']);

            $result = $stmt->execute();

            return $result;
        }

        
        protected function updateStock(Array $stock, $product_key){
            global $db;
            
            $query = "UPDATE
                        product_stock
                    SET
                        product_key = :product_key,
                        product_color_name = :product_color_name,
                        size_key = :size_key,
                        product_amount = :product_amount,
                        product_color = :product_color
                    WHERE
                        stock_key = :stock_key";
            
            $stmt = $db->prepare($query);
            $stmt->bindParam(':stock_key', $stock['stock_key']);
            $stmt->bindParam(':product_key', $product_key);
            $stmt->bindParam(':product_color_name', $stock['product_color_name']);
            $stmt->bindParam(':size_key', $stock['size_key']);
            $stmt->bindParam(':product_amount', $stock['product_amount']);
            $stmt->bindParam(':product_color', $stock['product_color']);

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
        public function getCategorySizes($category_key){
            
            global $db;

            $query = "SELECT
                        size_key,
                        size_name
                    FROM
                        product_size
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

        // ESPERA UM ARRAY CONTENDO AS INFORMAÇÕES DE PRODUTOS
        // SEUS INDICES DEVEM SER IGUAIS AOS NOMES DOS CAMPOS
        protected function updateProduct(Array $product){
            
            global $db;

            $query = "UPDATE
                            product
                        SET
                            product_name = :product_name,
                            category_key = :category_key,
                            subcategory_key = :subcategory_key,
                            product_value = :product_value,
                            product_promotion = :product_promotion,
                            product_promotion_value = :product_promotion_value";
            
            // SÓ REALIZA A ALTERAÇÃO DA FOTO QUANDO A MESMA ESTIVER SETADA NO ARRAY
            if(isset($product['product_photo']) && !empty($product['product_photo'])){
                $query .= ", product_photo = :product_photo";
            }

            $query .= " WHERE product_key = :product_key";

            $stmt = $db->prepare($query);
            $stmt->bindParam(':product_name', $product['product_name']);
            $stmt->bindParam(':product_value', $product['product_value']);
            $stmt->bindParam(':category_key', $product['category_key']);
            $stmt->bindParam(':subcategory_key', $product['subcategory_key']);
            $stmt->bindParam(':product_key', $product['product_key']);
            $stmt->bindParam(':product_promotion', $product['product_promotion']);
            $stmt->bindParam(':product_promotion_value', $product['product_promotion_value']);
            
            if(isset($product['product_photo']) && !empty($product['product_photo'])){
                $stmt->bindParam(':product_photo', $product['product_photo']);
            }

            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }

        // DELETA A LINHA DE ESTOQUE INFORMADA
        public function delStockLine($stock_key){

            global $db;

            $query = "DELETE FROM
                        product_stock
                    WHERE
                        stock_key = :stock_key";

            $stmt = $db->prepare($query);
            $stmt->bindParam(':stock_key', $stock_key);

            if($stmt->execute()){
                return true;
            }else{
                return false;
            }

        }
        public function delProduct($product_key){
            global $db;

            // DELETA O ESTOQUE RELACIONADO AO PRODUTO
            $this->delProductStock($product_key);

            $query = "DELETE FROM
                        product
                    WHERE
                        product_key = :product_key";

            $stmt = $db->prepare($query);
            $stmt->bindParam(':product_key', $product_key);

            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }

        // FUNÇÃO USADA PARA DELETAR O ESTOQUE NO MOMENTO DE EXCLUSÃO DO PRODUTO
        private function delProductStock($product_key){
            global $db;

            $query = "DELETE FROM
                        product_stock
                    WHERE
                        product_key = :product_key";

            $stmt = $db->prepare($query);
            $stmt->bindParam(':product_key', $product_key);

            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }

        // FUNÇÃO QUE RETORNA AS NOVIDADES, OS 20 ULTIMOS PRODUTOS CADASTRADOS
        public function getReleasesProducts(){
            global $db;

            $query = "SELECT
                        product_key,
                        product_name,
                        product_value,
                        product_photo
                    FROM
                        product
                    ORDER BY product_date DESC
                    LIMIT 20";
            
            $stmt = $db->prepare($query);

            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if($result){
                return $result;
            }
        }

        // FUNÇÃO QUE RETORNA AS NOVIDADES, OS 20 ULTIMOS PRODUTOS CADASTRADOS
        public function getPromotionProducts(){
            global $db;

            $query = "SELECT
                        product_key,
                        product_name,
                        product_value,
                        product_promotion_value,
                        product_photo
                    FROM
                        product
                    WHERE
                        product_promotion = 1
                    ";
            
            $stmt = $db->prepare($query);

            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if($result){
                return $result;
            }
        }
    }
