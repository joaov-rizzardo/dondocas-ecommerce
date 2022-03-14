<?php
class Routes {

    private $url;
    private $file;

    public function __construct($url){
        $this->url = $url;
    }

    public function getFile(){

        switch($this->url){
            case '':
                $this->file = './app/views/home.php';
            break;

            case 'produtos':
                $this->file = './app/views/products.php';
            break;

            case 'item':
                $this->file= './app/views/item.php';
            break;

            case 'adm/cadastro/produto':
                $this->file = './app/views/productsRegister.php';
            break;
        }

        return $this->file;
    }

    // USADO PARA ENCONTRAR O PATH RAIZ PARA OS INCLUDES
    public function getPathBase(){
        $arrPath = explode('/', $this->url);
        $pathBase = '';

        for($i = 0; $i < count($arrPath) - 1; $i++){
            $pathBase .= '../';
        }

        return $pathBase;
    }
}
?>