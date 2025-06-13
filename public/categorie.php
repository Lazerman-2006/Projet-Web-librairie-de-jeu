<?php

declare(strict_types=1);

use Entity\AppWebPage;
use Entity\Collection\CategorieCollection;
use Entity\Collection\GameCategoryCollection;
use Entity\Poster;

$webpage = new AppWebPage();
$cat= CategorieCollection::findAllCategorie();
$webpage->appendContent('<div class="bouton">');
$webpage->appendContent('<a href="index.php"><button>Retour à laccueil</button></a>');
$categorieId = isset($_GET['categorieId']) ? (int) $_GET['categorieId'] : null;
if ($categorieId === null || $categorieId <= 0) {
    die("categorieId invalide.");
}

$webpage->appendContent('<form method="GET" class="sort-menu">');
$webpage->appendContent('<input type="hidden" name="categorieId" value="' . $categorieId . '">'); // Ajoute genreId
$webpage->appendContent('<label><input type="radio" name="orderBy" value="title" checked> Trier par titre</label>');
$webpage->appendContent('<label><input type="radio" name="orderBy" value="year"> Trier par année</label>');
$webpage->appendContent('<button type="submit">Appliquer le tri</button>');
$webpage->appendContent('</form>');
$webpage->appendContent('</div>');
$orderBy = $_GET['orderBy'] ?? 'title'; // Récupère l'option de tri



$game = GameCategoryCollection::findGameByCategoryId($categorieId, $orderBy);


$webpage->appendContent("<div class = category_game>");
foreach ($game as $each) {
    $poster = Poster::findById($each->getPosterId());
    $jpeg = $poster->getJpeg();
    $base64 = base64_encode($jpeg);
    $image = '<img src="data:image/jpeg;base64,' . $base64 . '" alt="Poster">';
    $id = $each->getId();
    $name = $each->getName();
    $year = $each->getReleaseYear();
    $description = $each->getShortDescription();
    $webpage->appendContent("<div class = game><p>{$image} <div class = name_desc><a href=\"game.php?gameId=$id\">$name $year </a><p>$description</p></div></p></div>");
}
$webpage->appendContent("</div>");

# Obtenir le genre dans le titre de la page
$category = \Entity\Categorie::findDescById($categorieId);
$webpage->setTitle("Jeux vidéos : $category");


echo $webpage->toHTML();