<?php

declare(strict_types=1);

use Entity\AppWebPage;
use Entity\GameGenreCollection;
use Entity\Gender;
use Entity\Poster;

//Création de la page des genres
$webpage = new AppWebPage();

//Ajoute les bouton de tri par nom et pas année
$webpage->appendContent('<div class="bouton">');
$webpage->appendContent('<a href="index.php"><button>Retour à laccueil</button></a>');
$genreId = isset($_GET['genreId']) ? (int) $_GET['genreId'] : null;
if ($genreId === null || $genreId <= 0) {
    die("Genre ID invalide.");
}
//Formulaire des boutons
$webpage->appendContent('<form method="GET" class="sort-menu">');
$webpage->appendContent('<input type="hidden" name="genreId" value="' . $genreId . '">'); // Ajoute genreId
$webpage->appendContent('<label><input type="radio" name="orderBy" value="title" checked> Trier par titre</label>');
$webpage->appendContent('<label><input type="radio" name="orderBy" value="year"> Trier par année</label>');
$webpage->appendContent('<button type="submit">Appliquer le tri</button>');
$webpage->appendContent('</form>');
$webpage->appendContent('</div>');
// Récupère l'option de tri
$orderBy = $_GET['orderBy'] ?? 'title';

//Récupère la totalité des jeux du genre sélectionné
$games = GameGenreCollection::findGameByGenreId($genreId, $orderBy);

//Création de la liste des jeux
$webpage->appendContent("<div class = genre_game>");
//Boucle de création des balises pour chaques jeux
foreach ($games as $game) {
    $poster = Poster::findById($game->getPosterId());
    $jpeg = $poster->getJpeg();
    $base64 = base64_encode($jpeg);
    $image = '<img src="data:image/jpeg;base64,' . $base64 . '" alt="Poster">';
    $id = $game->getId();
    $name = $webpage->escapeString($game->getName());
    $year = $game->getReleaseYear();
    $description = $game->getShortDescription();
    $webpage->appendContent("<div class = game><p>{$image} <div class = name_desc><a href=\"game.php?gameId=$id\">$name $year </a><p>$description</p></div></p></div>");
}
$webpage->appendContent("</div>");

//Récupère le genre pour le mettre dans le titre de la page
$genre = Gender::findDescById($genreId);
$webpage->setTitle("Jeux vidéos : $genre");

//Affichage de la main
echo $webpage->toHTML();
