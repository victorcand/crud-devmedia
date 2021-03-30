<?php

$mensagem = '';
if (isset($_GET['status'])) {
    switch ($_GET['status']) {
        case 'success':
            $mensagem = '<div class="success">Ação executada com sucesso!</div>';
            break;

        case 'error':
            $mensagem = '<div class="danger">Ação não executada!</div>';
            break;
    }
}

$resultados = '';
foreach ($noticias as $noticia) {
    $resultados .= '<div class="card">
                    <div class="card-list">

                        <div class="titulo">
                            <h1>Título</h1>
                            <p>' . $noticia->titulo . '</p>
                        </div>

                        <div class="categoria">
                            <h3>Categoria</h3>
                            <p>' . $noticia->categoria . '</p>
                        </div>

                        <div>
                            <h3>Conteúdo</h3>
                            <p>' . $noticia->conteudo . '</p>
                        </div>

                    </div>

                    <div class="div-btn">
                        <a href="editar.php?id=' . $noticia->id . '"><button class="btn btn-info" type="submit">Editar</button></a>
                        <a href="excluir.php?id=' . $noticia->id . '"><button class="btn btn-danger" type="submit">Excluir</button></a>
                    </div>
                    </div>';

}

if (strlen($resultados)) {
    $resultados = '<div class="conteudo">'.$resultados.'</div>';
    
} 

if(empty(strlen($resultados))){
    $resultados .=  '<div class="conteudo-center">
                        <p class="info">Não há <strong>NOTÍCIA</strong> cadastrada.</p>
                    </div>';
}

?>
<main class="principal">
    <?=$mensagem?>

    <?=$resultados?>

</main>