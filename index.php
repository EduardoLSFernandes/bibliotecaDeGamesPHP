<?php

require __DIR__ . '/vendor/autoload.php';

use \App\Entity\Game;
use \App\Db\Pagination;

//BUSCA
$busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_STRING);

//FILTRO STATUS
$filtroStatus = filter_input(INPUT_GET, 'filtroStatus', FILTER_SANITIZE_STRING);
$filtroStatus = in_array($filtroStatus, ['j', 'f']) ? $filtroStatus : '';

//CONDICOES SQL
$condicoes = [
    strlen($busca) ? 'titulo LIKE "%' . str_replace(' ', '%', $busca) . '%"' : null,
    strlen($filtroStatus) ? 'status = "' . $filtroStatus . '"' : null
];

//REMOVE POSICOES VAZIAS
$condicoes = array_filter($condicoes);

//CLAUSULA WHERE
$where = implode(' AND ', $condicoes);

//QUANTIDADE TOTAL DE JOGOS
$quantidadeGames = Game::getQuantidadeGames($where);

//PAGINACAO
$obPagination = new Pagination($quantidadeGames, $_GET['pagina'] ?? 1, 10);

//OBTEM OS JOGOS
$games = Game::getGames($where, null, $obPagination->getLimit());

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/listagem.php';
include __DIR__ . '/includes/footer.php';
