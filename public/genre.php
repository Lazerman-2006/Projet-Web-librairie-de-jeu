<?php

declare(strict_types=1);

use Entity\AppWebPage;
use Entity\Collection\GenderCollection;
use Entity\GameGenreCollection;
use Entity\Gender;
use Entity\Poster;

/**
 *  Permet d'afficher la page Genre (Affiche tout les jeux qui font partie d'un genre)
 */
$webpage = new AppWebPage();

$Gender = GenderCollection::findAllGender();

$webpage->appendContent('<div class="genre_game">');
$webpage->appendContent('<a href="index.php"><button>Retour à laccueil</button></a>');
$genreId = isset($_GET['genreId']) ? (int) $_GET['genreId'] : null;
if ($genreId === null || $genreId <= 0) {
    die("Genre ID invalide.");
}
$webpage->appendContent('<form method="GET" class="sort-menu">');
$webpage->appendContent('<input type="hidden" name="genreId" value="' . $genreId . '">'); // Ajoute genreId
$webpage->appendContent('<label><input type="radio" name="orderBy" value="title" checked> Trier par titre</label>');
$webpage->appendContent('<label><input type="radio" name="orderBy" value="year"> Trier par année</label>');
$webpage->appendContent('<button type="submit">Appliquer le tri</button>');
$webpage->appendContent('</form>');
$webpage->appendContent('</div>');
$orderBy = $_GET['orderBy'] ?? 'title'; // Récupère l'option de tri


$games = GameGenreCollection::findGameByGenreId($genreId, $orderBy);

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
    //temporaire
    $description = "1";
    $webpage->appendContent("<div class = game><p>{$image} <div class = name_desc><a href=\"game.php?gameId=$id\">$name $year </a><p>$description</p></div></p></div>");
}

$webpage->appendContent("</div>");

# Obtenir le genre dans le titre de la page
$genre = Gender::findDescById($genreId);
$webpage->setTitle("Jeux vidéos : $genre");


echo $webpage->toHTML();
