<?php

declare(strict_types=1);

use Entity\AppWebPage;
use Entity\Collection\CategorieCollection;
use Entity\Collection\GameCategoryCollection;
use Entity\Collection\GameCollection;
use Entity\Collection\GenderCollection;
use Entity\GameGenreCollection;
use Entity\Poster;

//Création de la page d'un jeux
$webpage = new AppWebPage();

//Vérification du type de la variable 'gameId'
$gameId = isset($_GET['gameId']) ? (int)$_GET['gameId'] : null;
if ($gameId === null || $gameId <= 0) {
    die("Genre ID invalide.");
}

//Création du bouton de supression
$games = GameCollection::findByGameId($gameId);
//Récupère l'i d'un jeu pour le formulaire de supression
foreach ($games as $game) {
    $id = $game->getId();
    //Création du bouton de supression
    $webpage->appendContent("<div class='game_page'>");
    $webpage->appendContent("<div class='buton'>");
    $name = $webpage->escapeString($game->getName());
    $webpage->setTitle("Jeux vidéos : $name");
    $webpage->appendContent("<a href=\"Form/game_delete.php?gameId=$gameId\">Supprimer</a>");

    $webpage->appendContent("</div>");

    $webpage->appendContent("<div class = box_3>");

    $webpage->appendContent("<div class = box_1>");

    $webpage->appendContent("<div class = 'image'>");

    //Récupération du poster du jeu
    $posterId = $game->getPosterId();
    if ($posterId !== null) {
        $poster = Poster::findById($posterId);
        if ($poster !== null) {
            //Conversion du poster pour pouvoir l'afficher
            $jpeg = $poster->getJpeg();
            $base64 = base64_encode($jpeg);
            $image = '<img src="data:image/jpeg;base64,' . $base64 . '" alt="Poster">';
            $webpage->appendContent($image);
        }
    }
    $webpage->appendContent("</div>");

    //Vérification et affichage des logo des systèmes compatible du jeu
    $webpage->appendContent("<div class='platform'>");
    $icons = '';

    if ($game->isWindows()) {
        $icons .= '<img src="svg/windows.svg" alt="Windows" style="width: 40px;">';
    }
    if ($game->isLinux()) {
        $icons .= '<img src="svg/linux.svg" alt="Linux" style="width: 40px;">';
    }
    if ($game->isMac()) {
        $icons .= '<img src="svg/apple.svg" alt="Mac" style="width: 40px;">';
    }
    $webpage->appendContent("<div><p>Plaform: </p>$icons</div>");

    //Affichage de l'année de sortie du jeu
    $webpage->appendContent("<p>Année de sortie: {$game->getReleaseYear()}</p>");
    $webpage->appendContent("</div>");

    //Récupération de l'id du déveuloppeur
    $developerId = $game->getDeveloperId();
    //Condition d'affichage si il n'y a pas de déveuloppeur
    if ($developerId !== null) {
        $dev = \Entity\Developer::findById($developerId);
        if ($dev) {
            $webpage->appendContent("<div class='name'><p> Déveuloppeur: {$webpage->escapeString($dev->getName())} </p></div>");
        } else {
            $webpage->appendContent("<div class='name'><p>Déveuloppeur: Développeur inconnu</p></div>");
        }
    } else {
        $webpage->appendContent("<div class='name'><p>Déveuloppeur: Développeur inconnu</p></div>");
    }


    $webpage->appendContent("</div>");

    $webpage->appendContent("<div class = box_2>");

    $webpage->appendContent("<div class = data>");


    //Affichage du prix du jeu
    $price = $game->getPrice() / 100;

    $webpage->appendContent("<div><p>Prix : {$price}€</p></div>");


    //Affichage de la note métacritique si il y a une note métacritique
    if ($game->getMetacritic() !== null) {
        $webpage->appendContent("<div><p>Note: {$game->getMetacritic()}</p></div>");
    } else {
        $webpage->appendContent("<div><p>Note: Pas de Note</p></div>");
    }

    $webpage->appendContent("</div>");


    //Affiche la déscription d'un jeu
    $webpage->appendContent("<div class = 'desc'><p>{$game->getShortDescription()}</p></div>\n");

    $webpage->appendContent("</div>");

    $webpage->appendContent("</div>");

    //Création de l'affichage des catégories du jeu
    $webpage->appendContent("<div class = game_category>");

    //Récupération des catégories à partir de l'id du jeu
    $game = GameCategoryCollection::findCategoryIdByGameId($gameId);

    $webpage->appendContent("<div class = category_name><p>Categorie: </p></div>");

    //Boucle de création des balises de chaque catégories
    foreach ($game as $gamesCat) {
        $id = $gamesCat->getId();
        $name = $webpage->escapeString($gamesCat->getDescription());
        $webpage->appendContent("<p> <a href=\"categorie.php?categorieId=$id\">$name</a></p>\n");

    }
    $webpage->appendContent("</div>");

    //Création de l'affichage des genres du jeu
    $webpage->appendContent("<div class='game_genre'>");

    $webpage->appendContent("<div class='genre_name'><p>Genres: </p></div>");

    //Récupération des genres à partir de l'id du jeu
    $genres = GameGenreCollection::findGenreIdByGameId($gameId);

    //Boucle de création des balises de chaque genre
    foreach ($genres as $genre) {
        $genreId = $genre->getId();
        $genreName = $webpage->escapeString($genre->getDescription());
        $webpage->appendContent("<p><a href=\"genre.php?genreId=$genreId\">$genreName</a></p>");
    }
    $webpage->appendContent("</div>");

    //Bouton de retour à l'accueil
    $webpage->appendContent('<div class="bouton_game">');

    $webpage->appendContent("<a href='index.php'>Retour à l'accueil</a>");

    $webpage->appendContent('</div>');

    $webpage->appendContent("</div>");
}

echo $webpage->toHTML();
