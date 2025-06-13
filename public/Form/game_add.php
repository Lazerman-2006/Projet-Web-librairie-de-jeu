<?php
declare(strict_types=1);

use Entity\AppWebPage;
use Entity\Collection\CategorieCollection;
use Entity\Collection\GenderCollection;

$webpage = new AppWebPage();
$webpage->setTitle("Créer un nouveau jeu");

// Récupération des catégories et des genres
$categories = CategorieCollection::findAllCategorie();
$genres = GenderCollection::findAllGender();

$webpage->appendContent(<<<HTML
<h1>Créer un nouveau jeu</h1>
<form action="game_create_post.php" method="post">
    <label for="id">ID :</label><br>
    <input type="number" name="id" required><br><br>

    <label for="name">Nom du jeu :</label><br>
    <input type="text" name="name" required><br><br>

    <label for="releaseYear">Année de sortie :</label><br>
    <input type="number" name="releaseYear" required><br><br>

    <label for="shortDescription">Description :</label><br>
    <textarea name="shortDescription" required></textarea><br><br>

    <label for="price">Prix (€) :</label><br>
    <input type="number" name="price" required><br><br>

    <label>Compatibilité :</label><br>
    <input type="checkbox" name="windows" value="1"> Windows<br>
    <input type="checkbox" name="linux" value="1"> Linux<br>
    <input type="checkbox" name="mac" value="1"> Mac<br><br>

    <label for="metacritic">Note Metacritic (facultatif) :</label><br>
    <input type="number" name="metacritic"><br><br>

    <label for="developerId">ID Développeur (facultatif) :</label><br>
    <input type="number" name="developerId"><br><br>

    <label for="posterId">ID Poster (facultatif) :</label><br>
    <input type="number" name="posterId"><br><br>

    <fieldset>
        <legend>Catégories :</legend>
HTML);

// Catégories
foreach ($categories as $cat) {
    $id = $cat->getId();
    $name = $webpage->escapeString($cat->getDescription());
    $webpage->appendContent("<label><input type=\"checkbox\" name=\"categories[]\" value=\"$id\"> $name</label><br>");
}

$webpage->appendContent("</fieldset><br><fieldset><legend>Genres :</legend>");

// Genres
foreach ($genres as $genre) {
    $id = $genre->getId();
    $name = $webpage->escapeString($genre->getDescription());
    $webpage->appendContent("<label><input type=\"checkbox\" name=\"genres[]\" value=\"$id\"> $name</label><br>");
}

$webpage->appendContent(<<<HTML
    </fieldset><br>

    <button type="submit">Confirmer</button>
</form>

<div class="bouton_game">
    <a href="index.php"><button>Retour à l'accueil</button></a>
</div>
HTML);

echo $webpage->toHTML();
