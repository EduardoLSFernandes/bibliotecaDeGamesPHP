<main>

    <a href="index.php">
        <button class="btn btn-success mt-3"> Voltar </button>
    </a>

    <h2 class="mt-3"> Excluir Jogo </h2>

    <form method="post">

        <div class="form-group">
            <p>Você realmente deseja excluir o jogo <strong> <?= $obGame->titulo ?> </strong>?</p>
        </div>

        <div>
            <a href="index.php">
                <button type="button" class="btn btn-success"> Cancelar </button>
            </a>

            <button type="submit" name="excluir" class=" btn btn-danger">Excluir</button>
        </div>


    </form>

</main>