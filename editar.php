<?php

use App\Entity\Noticia;

require __DIR__ . "/vendor/autoload.php";

define("TITLE", "Editar Noticias");

//VALIDAÇÃO DO ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('location: index.php?status=error');
    exit;
}

//CONSULTA A VAGA
$obNoticia = Noticia::getNoticia($_GET['id']);

//VALIDAÇÃO DA VAGA
if (!$obNoticia instanceof Noticia) {
    header('location: index.php?status=error');
    exit;
}



//VALIDAÇÃO DO POST
if (!empty($_POST['titulo']) && !empty($_POST['categoria']) && !empty($_POST['conteudo'])) {

    $obNoticia->titulo = $_POST['titulo'];
    $obNoticia->categoria = $_POST['categoria'];
    $obNoticia->conteudo = $_POST['conteudo'];
    $obNoticia->atualizar();
    header('location: editar.php?id='.$_GET['id'].'&status=editar');
    exit;
}




require __DIR__ . "/include/header.php";
require __DIR__ . "/include/formulario.php";
require __DIR__ . "/include/footer.php";


// echo'<pre>';print_r($obNoticia); echo'</pre>'; exit;