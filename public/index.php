<?php

declare(strict_types=1);


use Entity\AppWebPage;
use Entity\CategorieCollection;
use Entity\Collection\GameCollection;

$webpage = new AppWebPage("Liste des artistes");

$games = CategorieCollection::findAllCategorie();



foreach ($games as $game) {
    $id = (int) $game->id;
    $name = $webpage->escapeString($game->name);
    $webpage->appendContent("<p> <a href=\"categorie.php?categorieId=$id\">$name,'</a></p>");
}

echo $webpage->toHTML();
