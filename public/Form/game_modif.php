<?php
declare(strict_types=1);

use Entity\AppWebPage;
use Entity\Collection\GameCollection;
use Entity\Collection\CategorieCollection;
use Entity\Collection\GenderCollection;
use Entity\Collection\GameCategoryCollection;
use Entity\GameGenreCollection;


$webpage = new AppWebPage();

$gameId = isset($_GET['gameId']) ? (int)$_GET['gameId'] : null;
if ($gameId === null || $gameId <= 0) {
    die("ID de jeu invalide.");
}

// Récupérer le jeu
$game = GameCollection::findById($gameId);
if (!$game) {
    die("Jeu introuvable.");
}

// Récupérer catégories et genres
$categories = CategorieCollection::findAllCategorie();
$genres = GenderCollection::findAllGender();

// Récupérer catégories et genres du jeu pour pré-cocher les cases
$gameCategories = GameCategoryCollection::findCategoryIdByGameId($gameId);
$gameGenres = GameGenreCollection::findGenreIdByGameId($gameId);

$selectedCategoryIds = [];
foreach ($gameCategories as $cat) {
    $selectedCategoryIds[] = $cat->getId();
}

$selectedGenreIds = [];
foreach ($gameGenres as $gen) {
    $selectedGenreIds[] = $gen->getId();
}

$webpage->setTitle("Modifier le jeu : " . $webpage->escapeString($game->getName()));

$priceEuros = $game->getPrice() / 100; // Si le prix est stocké en centimes

$webpage->appendContent(<<<HTML
<h1>Modifier le jeu</h1>
<form action="game_modif_post.php" method="post">
    <input type="hidden" name="id" value="{$game->getId()}">

    <label for="name">Nom du jeu :</label><br>
    <input type="text" name="name" value="{$webpage->escapeString($game->getName())}" required><br><br>

    <label for="releaseYear">Année de sortie :</label><br>
    <input type="number" name="releaseYear" value="{$game->getReleaseYear()}" required><br><br>

    <label for="shortDescription">Description :</label><br>
    <textarea name="shortDescription" required>{$webpage->escapeString($game->getShortDescription())}</textarea><br><br>

    <label for="price">Prix (€) :</label><br>
    <input type="number" step="0.01" name="price" value="{$priceEuros}" required><br><br>

    <label>Compatibilité :</label><br>
    <input type="checkbox" name="windows" value="1" 
HTML
);

#Verifie si windows linux et mac sont compatible
if ($game->isWindows()) $webpage->appendContent("checked");
$webpage->appendContent("> Windows<br>");

$webpage->appendContent('<input type="checkbox" name="linux" value="1" ');
if ($game->isLinux()) $webpage->appendContent("checked");
$webpage->appendContent('> Linux<br>');

$webpage->appendContent('<input type="checkbox" name="mac" value="1" ');
if ($game->isMac()) $webpage->appendContent("checked");
$webpage->appendContent('> Mac<br><br>');

$metacriticValue = $game->getMetacritic() ?? '';
$developerIdValue = $game->getDeveloperId() ?? '';
$posterIdValue = $game->getPosterId() ?? '';

$webpage->appendContent(<<<HTML
    <label for="metacritic">Note Metacritic (facultatif) :</label><br>
    <input type="number" name="metacritic" value="$metacriticValue"><br><br>

    <label for="developerId">ID Développeur (facultatif) :</label><br>
    <input type="number" name="developerId" value="$developerIdValue"><br><br>

    <label for="posterId">ID Poster (facultatif) :</label><br>
    <input type="number" name="posterId" value="$posterIdValue"><br><br>

    <fieldset>
        <legend>Catégories :</legend>
HTML);

// Catégories avec pré-sélection
foreach ($categories as $cat) {
    $id = $cat->getId();
    $name = $webpage->escapeString($cat->getDescription());
    $checked = in_array($id, $selectedCategoryIds) ? 'checked' : '';
    $webpage->appendContent("<label><input type=\"checkbox\" name=\"categories[]\" value=\"$id\" $checked> $name</label><br>");
}

$webpage->appendContent("</fieldset><br><fieldset><legend>Genres :</legend>");

// Genres avec pré-sélection
foreach ($genres as $genre) {
    $id = $genre->getId();
    $name = $webpage->escapeString($genre->getDescription());
    $checked = in_array($id, $selectedGenreIds) ? 'checked' : '';
    $webpage->appendContent("<label><input type=\"checkbox\" name=\"genres[]\" value=\"$id\" $checked> $name</label><br>");
}

$webpage->appendContent(<<<HTML
    </fieldset><br>

    <button type="submit">Mettre à jour</button>
</form>

<div class="bouton_game">
    <a href="index.php"><button>Retour à l'accueil</button></a>
</div>
HTML);

echo $webpage->toHTML();
