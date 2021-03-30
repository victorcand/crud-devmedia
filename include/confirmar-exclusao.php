<main class="principal-form">

    <section class="card">

        <h2>Excluir Noticia</h2>

        <form method="post">

            <div class="form-noticia">
                <p>Voce deseja realmente excluir a noticia <strong><?=$obNoticia->titulo?></strong></p>
            </div>

            <div class="form-control">
                <a href="index.php"><button type="button" class="btn btn-info">Cancelar</button></a>

                <button type="submit" name="excluir" class="btn btn-danger">Excluir</button>
            </div>

        </form>

    </section>

</main>