<?php

declare(strict_types=1);

use Entity\Game_Genre;
use Entity\AppWebPage;
use Entity\Collection\GenderCollection;

/**
 *  Permet d'afficher la page Genre (Affiche tout les jeux qui font partie d'un genre)
 */
$webpage = new AppWebPage("Jeux vidéos : le genre");

$Gender = GenderCollection::findAllGender();

$genreId = isset($_GET['genreId']) ? (int) $_GET['genreId'] : null;

if ($genreId === null || $genreId <= 0) {
    die("Genre ID invalide.");
}

$games = Game_Genre::findGameByGenreId($genreId);

foreach ($games as $game) {
    $id = $game->getId();
    $name = $webpage->escapeString($game->getName());
    $webpage->appendContent("<p><a href=\"game.php?gameId=$id\">$name,$genreId</a></p>");
}


echo $webpage->toHTML();
