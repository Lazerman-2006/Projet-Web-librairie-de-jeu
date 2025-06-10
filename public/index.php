<?php

declare(strict_types=1);
namespace Entity;

use Entity\AppWebPage;
use Entity\Collection\CategorieCollection;
use Entity\Collection\GenderCollection;

$webpage = new AppWebPage("Jeux vidéos");

$Categorie = CategorieCollection::findAllCategorie();

$Gender = GenderCollection::findAllGender();



foreach ($Categorie as $category) {
    $id = $category->getId();
    $name = $webpage->escapeString($category->getDescription());
    $webpage->appendContent("<p> <a href=\"categorie.php?categorieId=$id\">$name,'</a></p>");
}

foreach ($Gender as $gender) {
    $id = $gender->getId();
    $name = $webpage->escapeString($gender->getDescription());
    $webpage->appendContent("<p> <a href=\"genre.php?genreId=$id\">$name,'</a></p>");
}

echo $webpage->toHTML();
