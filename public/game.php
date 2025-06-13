<?php

declare(strict_types=1);

use Entity\AppWebPage;
use Entity\Collection\CategorieCollection;
use Entity\Collection\GameCategoryCollection;
use Entity\Collection\GameCollection;
use Entity\Collection\GenderCollection;
use Entity\GameGenreCollection;
use Entity\Poster;

$webpage = new AppWebPage();

$gameId = isset($_GET['gameId']) ? (int)$_GET['gameId'] : null;
if ($gameId === null || $gameId <= 0) {
    die("Genre ID invalide.");
}

$games = GameCollection::findByGameId($gameId);
foreach ($games as $game) {
    $id = $game->getId();

    $webpage->appendContent("<div class='game_page'>");
    $webpage->appendContent("<div class='buton'>");
    $name = $webpage->escapeString($game->getName());
    $webpage->setTitle("Jeux vidéos : $name");

    $webpage->appendContent("<a href=\"Form/game_delete.php?gameId=$gameId\">Supprimer</a>");
    $webpage->appendContent("</div>");
    $webpage->appendContent("<div class = box_3>");

    $webpage->appendContent("<div class = box_1>");

    $webpage->appendContent("<div class = 'image'>");
    $poster = Poster::findById($game->getPosterId());
    $jpeg = $poster->getJpeg();
    $base64 = base64_encode($jpeg);
    $image = '<img src="data:image/jpeg;base64,' . $base64 . '" alt="Poster">';
    $webpage->appendContent($image);

    $posterId = $game->getPosterId();
    if ($posterId !== null) {
        $poster = Poster::findById($posterId);
        if ($poster !== null) {
            $jpeg = $poster->getJpeg();
            $base64 = base64_encode($jpeg);
            $image = '<img src="data:image/jpeg;base64,' . $base64 . '" alt="Poster">';
            $webpage->appendContent($image);
        }
    }
    // Sinon on n'affiche rien (pas d'image)

>>>>>>> public/game.php
    $webpage->appendContent("</div>");

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
    $webpage->appendContent("<div>$icons</div>");
    $webpage->appendContent("<p>{$game->getReleaseYear()}</p>");
    $webpage->appendContent("</div>");

    $developerId = $game->getDeveloperId();
    if ($developerId !== null) {
        $dev = \Entity\Developer::findById($developerId);
        if ($dev) {
            $webpage->appendContent("<div class='name'><p>" . $webpage->escapeString($dev->getName()) . "</p></div>");
        } else {
            $webpage->appendContent("<div class='name'><p>Développeur inconnu</p></div>");
        }
    } else {
        $webpage->appendContent("<div class='name'><p>Développeur inconnu</p></div>");
    }


    $webpage->appendContent("</div>");

    $webpage->appendContent("<div class = box_2>");

    $webpage->appendContent("<div class = data>");


    $price = $game->getPrice() / 100;
    $webpage->appendContent("<div><p>{$price}€</p></div>");

    if ($game->getMetacritic() !== null) {
        $webpage->appendContent("<div><p>{$game->getMetacritic()}</p></div>");
    } else {
        $webpage->appendContent("<div><p>Pas de Note</p></div>");
    }

    $webpage->appendContent("</div>");



    $webpage->appendContent("<div class = 'desc'><p>{$game->getShortDescription()}</p></div>\n");
    $webpage->appendContent("</div>");
    $webpage->appendContent("</div>");
    $webpage->appendContent("<div class = game_category>");
    $game = GameCategoryCollection::findCategoryIdByGameId($gameId);
    $webpage->appendContent("<div class = category_name><p>Categorie: </p></div>");
    foreach ($game as $gamesCat) {
        $id = $gamesCat->getId();
        $name = $webpage->escapeString($gamesCat->getDescription());
        $webpage->appendContent("<p> <a href=\"categorie.php?categorieId=$id\">$name</a></p>\n");

    }
    $webpage->appendContent("</div>");

    // Affichage genres
    $webpage->appendContent("<div class='game_genre'>");
    $webpage->appendContent("<div class='genre_name'><p>Genres: </p></div>");
    $genres = GameGenreCollection::findGenreIdByGameId($gameId);
    foreach ($genres as $genre) {
        $genreId = $genre->getId();
        $genreName = $webpage->escapeString($genre->getDescription());
        $webpage->appendContent("<p><a href=\"genre.php?genreId=$genreId\">$genreName</a></p>");
    }
    $webpage->appendContent("</div>");

    $webpage->appendContent('<div class="bouton_game">');
    $webpage->appendContent('<a href="index.php">Retour à laccueil</a>');
    $webpage->appendContent('</div>');
    $webpage->appendContent("</div>");
}

echo $webpage->toHTML();
