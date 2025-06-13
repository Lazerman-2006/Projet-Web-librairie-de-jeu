<?php
declare(strict_types=1);

nameSpace public;

use Entity\Collection\GameCollection;
use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;

try {
    if (empty($_GET['gameId']) || !ctype_digit($_GET['gameId'])) {
        throw new ParameterException("Non, mauvais parametre");


    } else {
        $game = GameCollection::findById((int)$_GET['gameId']);
        $game->delete();
        header('Location: /index.php');
        exit;
    }
} catch (\Throwable $e) {
    throw new EntityNotFoundException("Erreur : " . $e->getMessage());
}