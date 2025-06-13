<?php

declare(strict_types=1);


use Entity\AppWebPage;
use Entity\Collection\CategorieCollection;
use Entity\Collection\GenderCollection;

//Création de la page "Liste des jeux"
$webpage = new AppWebPage("Liste des jeux");

//Récupération de toute lees catégories
$Categorie = CategorieCollection::findAllCategorie();

//récupération de tout les genres
$Gender = GenderCollection::findAllGender();
//Bouton création & modif"
$webpage->appendToHead("<div class = formulaire>");
$webpage->appendToHead("<a href=\"Form/game_add.php?\">Crée un jeu</a>");
$webpage->appendToHead("<a href=\"Form/game_select.php?\">Modifier un jeu</a>");
$webpage->appendToHead("</div>");


//Création de la liste des genres de jeux
$webpage->appendContent("<div class = gender>");
$webpage->appendContent("<h1>Genres</h1>\n");
//Boucle de création des balises de chaque genre
foreach ($Gender as $gender) {
    $id = $gender->getId();
    $name = $webpage->escapeString($gender->getDescription());
    $webpage->appendContent("<p> <a href=\"genre.php?genreId=$id\">$name</a></p>");
}
$webpage->appendContent("</div>");


//Création de la liste des catégories de jeux
$webpage->appendContent("<div class = category>");
$webpage->appendContent("<h1>Catégories</h1>\n");
//Boucle de création des balises de chaque catégorie
foreach ($Categorie as $cat) {
    $id = $cat->getId();
    $name = $webpage->escapeString($cat->getDescription());
    $webpage->appendContent("<p> <a href=\"categorie.php?categorieId=$id\">$name</a></p>\n");
}
$webpage->appendContent("</div>");

//Affichage de la page
echo $webpage->toHTML();
