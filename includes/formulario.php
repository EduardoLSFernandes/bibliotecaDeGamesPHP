<main>

    <section>
        <a href="index.php">
            <button class="btn btn-success mt-3"> Voltar </button>
        </a>
    </section>

    <h2 class="mt-3"> <?= TITLE ?></h2>

    <form method="post">

        <div class="form-group">
            <label>Título</label>
            <input type="text" class="form-control" name="titulo" required value="<?= $obGame->titulo ?>">
        </div>

        <div class="form-group ">
            <label>Descrição</label>
            <textarea class="form-control" name="descricao" rows="5" required><?= $obGame->descricao ?></textarea>
        </div>

        <div class="form-group">
            <label>Status</label>

            <div class="px-0" >
                <div class="form-check form-check-inline px-0">
                    <label class="form-control">
                        <input type="radio" name="status" value="j" checked> Jogando
                    </label>
                </div>

                <div class="form-check form-check-inline px-0">
                    <label class="form-control">
                        <input type="radio" name="status" value="f" <?= $obGame->status == 'f' ? 'checked' : '' ?>> Finalizado
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-success "> Enviar </button>
        </div>


    </form>

</main>