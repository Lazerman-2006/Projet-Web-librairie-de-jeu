<?php

declare(strict_types=1);


use Entity\AppWebPage;
use Entity\Collection\CategorieCollection;
use Entity\Collection\GenderCollection;

$webpage = new AppWebPage("Liste des jeux");

$Categorie = CategorieCollection::findAllCategorie();

$Gender = GenderCollection::findAllGender();


$webpage->appendContent("<div class = gender>");
$webpage->appendContent("<h1>Genres</h1>\n");
foreach ($Gender as $gender) {
    $id = $gender->getId();
    $name = $webpage->escapeString($gender->getDescription());
    $webpage->appendContent("<p> <a href=\"genre.php?genreId=$id\">$name</a></p>");
}
$webpage->appendContent("</div>");

$webpage->appendContent("<div class = category>");
$webpage->appendContent("<h1>Catégories</h1>\n");
foreach ($Categorie as $cat) {
    $id = $cat->getId();
    $name = $webpage->escapeString($cat->getDescription());
    $webpage->appendContent("<p> <a href=\"categorie.php?categorieId=$id\">$name</a></p>\n");
}
$webpage->appendContent("</div>");

echo $webpage->toHTML();
