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
<script src="node_modules/@glidejs/glide/dist/glide.min.js"></script>

<!-- CONFIGS GERAIS CSS -->
<link rel="stylesheet" href="css/general.css">

<?php
    require_once './app/models/routes.php';

    $url = isset($_GET['url']) ? $_GET['url'] : '';
    
    $route = new Routes($url);

    $path = $route->getFile();
    require_once 'app/views/navbar.php';
    require_once $path;
?>
<!--'
       ,.                 .,
       ,: ':.    .,.    .:' :,
       ,',   '.:'   ':.'   ,',
       : '.  '         '  .' :
       ', : '           ' : ,'
       '.' .,:,.   .,:,. '.'
        ,:    V '. .' V    :,
       ,:        / '        :,
       ,:                   :,
        ,:       =:=       :,
         ,: ,     :     , :,
          :' ',.,' ',.,:' ':
         :'      ':WW::'   '.
        .:'       '::::'   ':
        ,:        '::::'    :,
        :'         ':::'    ':
       ,:           ':''     :.
      .:'             '.     ',.
     ,:'               ''     '.
     .:'               .',    ':
    .:'               .'.,     :
    .:                .,''     :
    ::                .,''    ,:
    ::              .,'','   .:'
  .,::'.           .,','     ::::.
.:'     ',.       ,:,       ,WWWWW,
:'        :       :W:'     :WWWWWWW,          .,.
:         ',      WWW      WWWWWWWWW          '::,
'.         ',     WWW     :WWWWWWWWW            '::,
 '.         :     WWW     :WWWWWWWW'             :::
  '.       ,:     WWW     :WWWWWWW'             .:::
   '.     .W:     WWW     :WWWWWW'           .,:::'
    '.   :WW:     WWW     :WWWWW'      .,,:::::''
   .,'   ''::     :W:     :WWWWW.  .,::::''
,'        ''','',',','','''WWWWW::::''
 ':,,,,,,,':  :  : : :  :  :WWWW''' BY POSERLACK

-->