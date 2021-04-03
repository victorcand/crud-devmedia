<?php

use App\Entity\Noticia;

require __DIR__ . "/vendor/autoload.php";

//VALIDAÇÃO DO ID
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    header('location: index.php?status=error');
    exit;
}

//CONSULTA A VAGA
$obNoticia = Noticia::getNoticia($_GET['id']);


//VALIDAÇÃO DA VAGA
if(!$obNoticia instanceof Noticia){
    header('location: index.php?status=error');
    exit;
}


//VALIDAÇÃO DO POST
if(isset($_POST['excluir'])){
    $obNoticia->excluir();
    header('Location: index.php?status=excluir');
    exit;
}

require __DIR__ . "/include/header.php";
require __DIR__ . "/include/confirmar-exclusao.php";
require __DIR__ . "/include/footer.php";
