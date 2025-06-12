<?php

declare(strict_types=1);

use Entity\AppWebPage;
use Entity\Collection\GameCollection;
use Entity\Poster;

/**
 *  Permet d'afficher la page Genre (Affiche tout les jeux qui font partie d'un genre)
 */
$webpage = new AppWebPage();


$gameId = isset($_GET['gameId']) ? (int)$_GET['gameId'] : null;
if ($gameId === null || $gameId <= 0) {
    die("Genre ID invalide.");
}

$games = GameCollection::findByGameId($gameId);

foreach ($games as $game) {
    $id = $game->getId();

    #Name
    $name = $webpage->escapeString($game->getName());

    #Prix

    $webpage->appendContent("{$game->getPrice()} \n ");

    # Poster

    $poster = Poster::findById($game->getPosterId());
    $jpeg = $poster->getJpeg();
    $base64 = base64_encode($jpeg);
    $image = '<img src="data:image/jpeg;base64,' . $base64 . '" alt="Poster">';
    $webpage->appendContent($image);

    #Annee publication :

    $webpage->appendContent("{$game->getReleaseYear()} \n ");

    #Developpeur


    $dev = \Entity\Developer::findById($game->getId());

    if ($dev) {
        $webpage->appendContent("{$dev->getName()}");
    } else {
        $webpage->appendContent("Développeur inconnu");
    }

    # Note
    if ($game->getMetacritic()) {
        $webpage->appendContent("{$game->getMetacritic()}");
    } else {
        $webpage->appendContent("Pas de note");
    }

    #Description

    $webpage->appendContent("{$game->getShortDescription()}");

    # Plateforme

    $icons = '';

    if ($game->isWindows()) {
        $icons .= '<img src="svg/windows.svg" alt="Windows" style="width: 40px;">';
    }
    if ($game->isLinux()) {
        $icons .= '<img src="svg/linux.svg" alt="Linux" style="width: 40px;">';
    }
    if ($game->isMac()) {
        $icons .= '<img src="svg/apple.svg" alt="Mac" style="width: 40px;">';
    }

    $webpage->appendContent($icons);

    # Affichage cat et genres


    # Obtenir le titre du jeu dans le titre de la page
    $webpage->setTitle("Jeux vidéos : $name");



    echo $webpage->toHTML();
}