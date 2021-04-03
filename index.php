<?php

require __DIR__ . "/vendor/autoload.php";

use \App\Entity\Noticia;

//BUSCA
$busca = filter_input(INPUT_GET,'busca',FILTER_SANITIZE_STRING);

//CONDIÇÕES SQL
$condicao = [
    strlen($busca) ? 'titulo LIKE "%'. str_replace(' ','%',$busca).'%" OR categoria LIKE "%'. str_replace(' ','%',$busca).'%" OR conteudo LIKE "%'. str_replace(' ','%',$busca).'%" ' : null,
];

//CLAUSALA WHERE 
$where = implode($condicao);

$noticias = Noticia::getNoticias($where,'id DESC');


require __DIR__ . "/include/header.php";
require __DIR__ . "/include/listagem.php";
require __DIR__ . "/include/footer.php";
 