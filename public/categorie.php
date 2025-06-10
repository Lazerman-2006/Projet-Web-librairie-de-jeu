<?php

declare(strict_types=1);

use Entity\AppWebPage;
use Entity\Collection\GameCategoryCollection;

$webpage = new AppWebPage("Jeux vidéos : la catégorie");

$categorieId = (int) $_GET['categorieId'];

$game = GameCategoryCollection::findGameByCategoryId($categorieId);

foreach ($game as $each) {
    $id = $each->getId();
    $name = $each->getName();
    $year = $each->getReleaseYear();
    $webpage->appendContent("<p> <a href=\"categorie.php?categorieId=$id\">$name,'</a></p>");
}

# Obtenir le genre dans le titre de la page
$genre = \Entity\Categorie::findDescById($categorieId);
$webpage->setTitle("Jeux vidéos : $genre");

echo $webpage->toHTML();