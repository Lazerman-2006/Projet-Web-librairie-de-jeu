<?php

declare(strict_types=1);

use Entity\AppWebPage;
use Entity\Collection\CategorieCollection;
use Entity\Collection\GameCategoryCollection;
use Entity\Poster;

//Création de la page des genres
$webpage = new AppWebPage();

//Ajoute les bouton de tri par nom et pas année
$webpage->appendContent('<div class="bouton">');
$webpage->appendContent('<a href="index.php"><button>Retour à laccueil</button></a>');
$categorieId = isset($_GET['categorieId']) ? (int) $_GET['categorieId'] : null;
if ($categorieId === null || $categorieId <= 0) {
    die("categorieId invalide.");
}
//Formulaire des boutons
$webpage->appendContent('<form method="GET" class="sort-menu">');
$webpage->appendContent('<input type="hidden" name="categorieId" value="' . $categorieId . '">'); // Ajoute genreId
$webpage->appendContent('<label><input type="radio" name="orderBy" value="title" checked> Trier par titre</label>');
$webpage->appendContent('<label><input type="radio" name="orderBy" value="year"> Trier par année</label>');
$webpage->appendContent('<button type="submit">Appliquer le tri</button>');
$webpage->appendContent('</form>');
$webpage->appendContent('</div>');
// Récupère l'option de tri
$orderBy = $_GET['orderBy'] ?? 'title';


//Récupère la totalité des jeux de la catégorie sélectionné
$game = GameCategoryCollection::findGameByCategoryId($categorieId, $orderBy);

//Création de la liste des jeux
$webpage->appendContent("<div class = category_game>");
//Boucle de création des balises pour chaques jeux
foreach ($game as $each) {
    $posterId = $each->getPosterId();
    if ($posterId !== null) {
        $poster = Poster::findById($posterId);
        $jpeg = $poster->getJpeg();
        $base64 = base64_encode($jpeg);
        $image = '<img src="data:image/jpeg;base64,' . $base64 . '" alt="Poster">';
    } else {
        $image = '';
    }

    $id = $each->getId();
    $name = $each->getName();
    $year = $each->getReleaseYear();
    $description = $each->getShortDescription();
    $webpage->appendContent("<div class='game'><p>{$image} <div class='name_desc'><a href=\"game.php?gameId=$id\">$name $year</a><p>$description</p></div></p></div>");
}
$webpage->appendContent("</div>");

//Récupère la cétgorie pour le mettre dans le titre de la page
$category = \Entity\Categorie::findDescById($categorieId);
$webpage->setTitle("Jeux vidéos : $category");

//Affichage de la page
echo $webpage->toHTML();