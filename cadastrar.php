<?php

require __DIR__ . '/vendor/autoload.php';

define('TITLE', 'Cadastrar Jogo');

use \App\Entity\Game;
$obGame = new Game;

//VALIDACAO DO POST
if (isset($_POST['titulo'], $_POST['descricao'], $_POST['status'])) {

    $obGame->titulo     = $_POST['titulo'];
    $obGame->descricao  = $_POST['descricao'];
    $obGame->status     = $_POST['status'];

    $obGame->cadastrar();

    header('location: index.php?status=success');
    exit;
}

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/formulario.php';
include __DIR__ . '/includes/footer.php';
