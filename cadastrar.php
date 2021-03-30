<?php

use App\Entity\Noticia;

require __DIR__ . "/vendor/autoload.php";

define("TITLE","Cadastrar Noticias");

$obNoticia = new Noticia;


//VALIDAÇÃO DO POST

if(!empty($_POST['titulo']) && !empty($_POST['categoria']) && !empty($_POST['conteudo'])){
    
    $obNoticia->titulo = $_POST['titulo'];
    $obNoticia->categoria = $_POST['categoria'];
    $obNoticia->conteudo = $_POST['conteudo'];
    $obNoticia->cadastrar();

    header('Location: cadastrar.php?status=success');
    exit;
}


require __DIR__ . "/include/header.php";
require __DIR__ . "/include/formulario.php";
require __DIR__ . "/include/footer.php";
