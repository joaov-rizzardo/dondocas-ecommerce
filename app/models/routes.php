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
        }

        return $this->file;
    }
}
?>