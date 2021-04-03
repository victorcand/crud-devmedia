<?php

$mensagem = '';
if (isset($_GET['status'])) {
    switch ($_GET['status']) {
        case 'success':
            $mensagem = '<div class="success">Ação executada com sucesso!</div>';
            break;

        case 'cadastro':
            $mensagem = '<div class="success">Cadastro realizado com sucesso!</div>';
            break;

        case 'editar':
            $mensagem = '<div class="success">Alteração realizada com sucesso!</div>';
            break;

        case 'error':
            $mensagem = '<div class="danger">Ação não executada!</div>';
            break;
    }
}

?>

<main class="principal-form">

    <div class="card-cadastro">
    
        <?=$mensagem?>

        <h2><?=TITLE?></h2>

        <form method="post">
            <div class="label-float">
                <input type="text" name="titulo" value="<?=$obNoticia->titulo?>" required="">
                <label>Titulo</label>
            </div>
            <br>
            <div class="label-float">
                <input type="text" name="categoria" value="<?=$obNoticia->categoria?>" required="">
                <label>Categoria</label>
            </div>

            <div class="form-noticia textarea">
                <label>Conteudo da Noticia</label>
                <textarea name="conteudo" cols="10" rows="7" required=""><?=$obNoticia->conteudo?></textarea>
            </div>

            <div class="form-control">
                <a href="index.php"><button type="button" class="btn btn-success">Voltar</button></a>

                <button type="submit" class="btn btn-success">Enviar</button>
            </div>

        </form>

    </div>

</main>