<?php
    Class Log {

        // GERA O LOG DO CONTEUDO PASSADO COMO PARAMETRO
        public static function writelog($filename, $content){
            $path = __DIR__. "/../../logs/{$filename}.log";
            
            $file = fopen($path, 'a+');

            if(is_array($content) || is_object($content)){
                fwrite($file, print_r($content, true));
            }else{
                fwrite($file, $content.PHP_EOL);
            }

            fclose($file);
        }
    }
?>