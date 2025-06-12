<?php

declare(strict_types=1);

use Entity\AppWebPage;
use Entity\Collection\GameCategoryCollection;
use Entity\Poster;

$webpage = new AppWebPage("Jeux vidéos : la catégorie");

$categorieId = (int) $_GET['categorieId'];

$game = GameCategoryCollection::findGameByCategoryId($categorieId);

$webpage->appendContent("<div class = category_game>");

foreach ($game as $each) {
    $poster = Poster::findById($each->getPosterId());
    $jpeg = $poster->getJpeg();
    $base64 = base64_encode($jpeg);
    $image = '<img src="data:image/jpeg;base64,' . $base64 . '" alt="Poster">';
    $id = $each->getId();
    $name = $each->getName();
    $year = $each->getReleaseYear();
    $webpage->appendContent("<p>{$image} <a href=\"game.php?gameId=$id\">$name $year</a></p>");
}
$webpage->appendContent("</div>");

# Obtenir le genre dans le titre de la page
$category = \Entity\Categorie::findDescById($categorieId);
$webpage->setTitle("Jeux vidéos : $category");

echo $webpage->toHTML();