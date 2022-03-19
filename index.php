<?php
    require_once './app/models/routes.php';
    require_once './app/services/dbConnection.php';   
    $url = isset($_GET['url']) ? $_GET['url'] : '';
        
    $route = new Routes($url);

    // RECUPERA O ARQUIVO REFERENTE A ROTA ACESSADA
    $path = $route->getFile();

    if(!$path){
        throw new Exception("This route doensn't exist on the server", 1);
    }

    // RECUPERA O PATH BASE PARA REFERENCIAR ARQUIVOS NO PROJETO
    $pathBase = $route->getPathBase();


?>

<title>Dondocas - Moda Feminina</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- JQUERY -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!-- GLIDER -->
<script src="<?=$pathBase?>node_modules/@glidejs/glide/dist/glide.min.js"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&family=Poppins:wght@400;700&family=Questrial&display=swap" rel="stylesheet">

<!-- CONFIGS GERAIS CSS -->
<link rel="stylesheet" href="<?=$pathBase?>css/general.css">

<?php
    require_once 'app/components/navbar.php';
    include 'app/components/fixedButtons.php';
    require_once $path;
?>

<!-- 
                                      /|
                                     |\|
                                     |||
                                     |||
                                     |||
                                     |||
                                     |||
                                     |||
                                  ~-[{o}]-~
                                     |/|
                                     |/|
             ///~`     |\\_          `0'         =\\\\         . .
            ,  |='  ,))\_| ~-_                    _)  \      _/_/|
           / ,' ,;((((((    ~ \                  `~~~\-~-_ /~ (_/\
         /' -~/~)))))))'\_   _/'                      \_  /'  D   |
        (       (((((( ~-/ ~-/                          ~-;  /    \--_
         ~~--|   ))''    ')  `                            `~~\_    \   )
             :        (_  ~\           ,                    /~~-     ./
              \        \_   )--__  /(_/)                   |    )    )|
    ___       |_     \__/~-__    ~~   ,'      /,_;,   __--(   _/      |
  //~~\`\    /' ~~~----|     ~~~~~~~~'        \-  ((~~    __-~        |
((()   `\`\_(_     _-~~-\                      ``~~ ~~~~~~   \_      /
 )))     ~----'   /      \      BY POSERLACK                 )       )
  (         ;`~--'        :                                _-    ,;;(
            |    `\       |                             _-~    ,;;;;)
            |    /'`\     ;                          _-~          _/
           /~   /    |    )                         /;;;''  ,;;:-~
          |    /     / | /                         |;;'   ,''
          /   /     |  \\|                         |   ,;(   
        _/  /'       \  \_)                   .---__\_    \,--._______
       ( )|'         (~-_|                   (;;'  ;;;~~~/' `;;|  `;;;\
        ) `\_         |-_;;--__               ~~~----__/'    /'_______/
        `----'       (   `~--_ ~~~;;------------~~~~~ ;;;'_/'
                     `~~~~~~~~'~~~-----....___;;;____---~~
-->
