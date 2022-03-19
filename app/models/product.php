<?php

    require_once __DIR__.'/../DAO/productDAO.php';
    
    class Product extends ProductDAO{
        private $product_key;

        private $product_name;

        private $product_value;

        private $product_photo;

        private $category_key;

        private $subcategory_key;

        private $product_promotion_key;

        private $product_promotion_value;

        private $product_date;

        private $stock;

        public function __construct(){

        }

        public function __get($attribute){
            return $this->$attribute;
        }

        public function __set($attribute, $value){
            $this->$attribute = $value;
        }

        // ESPERA UM ARRAY CONTENDO VALORES PARA OS ABRIBUTOS DA CLASSE
        // OS INDICES DO ARRAY DEVEM SER IGUAIS AO NOME DO ATRIBUTO QUE SERÁ ATRIBUÍDO SEU VALOR
        public function handleCreateProduct(Array $product){
            if(!is_array($product)){
                return false;
            }

            foreach($product as $key => $value){
                // VERIFICAR SE A PROPRIEDADE EXISTE NA CLASSE
                if(!property_exists($this, $key)){
                    continue;
                }
                
                $this->$key = $value;
            }
            
        }

        public function saveProduct(){
            // RECUPERA UM ARRAY COM AS INFORMAÇÕES DO PRODUTO
            $productInformation = get_object_vars($this);
            /*
             ATRIBUI O VALOR DE ESTOQUE PARA UMA VARIAVEL E EM SEGUIDA RETIRA ELA DO ARRAY DE PRODUTOS
             SERÁ FEITA INSERÇÕES SEPARADAS
            */

            $stockInformation = $productInformation['stock'];
            unset($productInformation['stock']);            
            // SE ESTIVER SETADO PRODUCT_KEY É UM UPDATE, SE NÃO, UM INSERT
            if(isset($productInformation['product_key'])){

            }else{
                $product_key = $this->insertProduct($productInformation);
                if(!$product_key){
                    return false;
                };

                $this->product_key = $product_key;

            }
            
            if(!is_array($stockInformation)){
                return true;
            }

            foreach($stockInformation as $stock){
                $this->replaceStock($stock, $this->product_key);
            }

            return true;
            

        }
            
        
    }
?>