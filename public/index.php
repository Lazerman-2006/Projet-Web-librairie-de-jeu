<?php

declare(strict_types=1);


use Entity\AppWebPage;
use Entity\Collection\CategorieCollection;
use Entity\Collection\GenderCollection;

$webpage = new AppWebPage("Liste des artistes");

$Categorie = CategorieCollection::findAllCategorie();

$Gender = GenderCollection::findAllGender();



foreach ($Categorie as $category) {
    $id = $category->getId();
    $name = $webpage->escapeString($category->getName());
    $webpage->appendContent("<p> <a href=\"categorie.php?categorieId=$id\">$name,'</a></p>");
}

foreach ($Gender as $gender) {
    $id = $gender->getId();
    $name = $webpage->escapeString($gender->getName());
    $webpage->appendContent("<p> <a href=\"categorie.php?categorieId=$id\">$name,'</a></p>");
}

echo $webpage->toHTML();
