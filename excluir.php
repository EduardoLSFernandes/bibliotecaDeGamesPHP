<?php

require __DIR__ . '/vendor/autoload.php';

use \App\Entity\Game;

//VALIDACAO DO ID
if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {
    header('location: index.php?status=error');
    exit;
}

//CONSULTA O GAME
$obGame = Game::getGame($_GET['id']);

//VALIDACAO DO GAME
if (!$obGame instanceof Game) {
    header('location: index.php?status=error');
    exit;
}

//VALIDACAO DO POST
if (isset($_POST['excluir'])) {

    $obGame->excluir();

    header('location: index.php?status=success');
    exit;
}

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/confirmar-exclusao.php';
include __DIR__ . '/includes/footer.php';
