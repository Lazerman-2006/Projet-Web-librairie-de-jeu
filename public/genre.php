<?php

declare(strict_types=1);

use Entity\Game_Genre;
use Entity\AppWebPage;
use Entity\Collection\GenderCollection;
use Entity\Gender;
use Entity\Poster;

/**
 *  Permet d'afficher la page Genre (Affiche tout les jeux qui font partie d'un genre)
 */
$webpage = new AppWebPage();

$Gender = GenderCollection::findAllGender();

$genreId = isset($_GET['genreId']) ? (int) $_GET['genreId'] : null;
if ($genreId === null || $genreId <= 0) {
    die("Genre ID invalide.");
}


$games = Game_Genre::findGameByGenreId($genreId);

$webpage->appendContent("<div class = genre_game>");

foreach ($games as $game) {
    $poster = Poster::findById($game->getPosterId());
    $jpeg = $poster->getJpeg();
    $base64 = base64_encode($jpeg);
    $image = '<img src="data:image/jpeg;base64,' . $base64 . '" alt="Poster">';
    $id = $game->getId();
    $name = $webpage->escapeString($game->getName());
    $year = $game->getReleaseYear();
    $description = $game->getShortDescription();
    $webpage->appendContent("<div><p>{$image} <a href=\"game.php?gameId=$id\">$name $year </a></div>$description</p>");
}

$webpage->appendContent("</div>");

# Obtenir le genre dans le titre de la page
$genre = Gender::findDescById($genreId);
$webpage->setTitle("Jeux vidéos : $genre");


echo $webpage->toHTML();
