<?php

$mensagem = '';
if (isset($_GET['status'])) {
    switch ($_GET['status']) {
        case 'success':
            $mensagem = '<div class="alert alert-success mt-3">Ação Executada Com Sucesso</div>';
            break;

        case 'error':
            $mensagem = '<div class="alert alert-danger mt-3">Ação Não Executada</div>';
            break;
    }
}

$resultados = '';
foreach ($games as $game) {
    $resultados .= '<tr>
                        <td>' . $game->id . '</td>
                        <td>' . $game->titulo . '</td>
                        <td>' . $game->descricao . '</td>
                        <td>' . ($game->status == 'j' ? 'Jogando' : 'Finalizado') . '</td>
                        <td>' . date('d/m/Y à\s H:i:s', strtotime($game->data)) . '</td>
                        <td class="text-center">
                            <a href="editar.php?id=' . $game->id . '" >
                                <button type="button" class="btn btn-info mr-0"> Editar </button>
                            </a> 

                            <a href="excluir.php?id=' . $game->id . '" >
                            <button type="button" class="btn btn-danger ml-0"> Excluir </button>
                             </a>                           
                        </td>
                    </tr>';
}

$resultados = strlen($resultados) ? $resultados : '<tr>
    <td colspan="6" class="text-center">Nenhum Jogo Cadastrado
    </td>
</tr>';

//GETS
unset($_GET['status']);
unset($_GET['pagina']);

$gets = http_build_query($_GET);

//PAGINACAO
$paginacao = '';
$paginas = $obPagination->getPages();
foreach ($paginas as $key => $pagina) {
    $class = $pagina['atual'] ? 'btn-primary' : 'btn-secondary';
    $paginacao .= '<a href="?pagina=' . $pagina['pagina'] . '&' . $gets . '"
                        <button type="button" class="btn ' . $class . ' mb-5 mx-1 pr-4">' . $pagina['pagina'] . '</button>
                    </a>';
}

?>

<main>

    <?= $mensagem ?>
    <section>
        <a href="cadastrar.php">
            <button class="btn btn-success mt-3"> Novo Jogo </button>
        </a>

    </section>

    <section>

        <form method="get">
            <div class="row my-4">

                <div class="col">
                    <label>Buscar por Título</label>
                    <input type="text" name="busca" class="form-control" value="<?= $busca ?>">
                </div>

                <div class="col">
                    <label>Status</label>
                    <select name="filtroStatus" class="form-control">
                        <option value="">Jogando/Finalizado</option>
                        <option value="j" <?= $filtroStatus == 'j' ? 'selected' : '' ?>>Jogando</option>
                        <option value="f" <?= $filtroStatus == 'f' ? 'selected' : '' ?>>Finalizado</option>

                    </select>
                </div>

                <div class="col d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>

            </div>
        </form>

    </section>

    <section>
        <div class="table table-responsive-sm">
            <table class="table table-hover table-bordered table-striped  bg-light mt-3">

                <thead class="text-center">
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Descrição</th>
                        <th>Status</th>
                        <th>Data</th>
                        <th colspan="2">Ações</th>
                    </tr>
                </thead>

                <body>
                    <?= $resultados ?>
                </body>
            </table>
        </div>
    </section>

    <section>
        <?= $paginacao ?>
    </section>

</main>