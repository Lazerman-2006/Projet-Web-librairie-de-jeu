<?php

declare(strict_types=1);

use Entity\AppWebPage;
use Entity\Collection\GenderCollection;
use Entity\GameGenreCollection;
use Entity\Gender;

/**
 *  Permet d'afficher la page Genre (Affiche tout les jeux qui font partie d'un genre)
 */
$webpage = new AppWebPage();

$Gender = GenderCollection::findAllGender();
$webpage->appendContent('<div class="bouton">');
$webpage->appendContent('<a href="index.php"><button>Retour à laccueil</button></a>');
$webpage->appendContent('</div>');
$genreId = isset($_GET['genreId']) ? (int) $_GET['genreId'] : null;
if ($genreId === null || $genreId <= 0) {
    die("Genre ID invalide.");
}


$games = GameGenreCollection::findGameByGenreId($genreId);

foreach ($games as $game) {
    $id = $game->getId();
    $name = $webpage->escapeString($game->getName());
    $webpage->appendContent("<p><a href=\"game.php?gameId=$id\">$name</a></p>");
}

# Obtenir le genre dans le titre de la page
$genre = Gender::findDescById($genreId);
$webpage->setTitle("Jeux vidéos : $genre");


echo $webpage->toHTML();
