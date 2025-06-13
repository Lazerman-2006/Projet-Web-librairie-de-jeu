<?php
declare(strict_types=1);

use Entity\Collection\GameCollection;
use Entity\Collection\GameCategoryCollection;
use Entity\Game;
use Entity\GameGenreCollection;

// Récupération des données POST
$id = isset($_POST['id']) ? (int)$_POST['id'] : null;
$name = $_POST['name'] ?? null;
$releaseYear = isset($_POST['releaseYear']) ? (int)$_POST['releaseYear'] : null;
$shortDescription = $_POST['shortDescription'] ?? null;
$price = isset($_POST['price']) ? (float)$_POST['price'] : null;
$windows = isset($_POST['windows']) ? 1 : 0;
$linux = isset($_POST['linux']) ? 1 : 0;
$mac = isset($_POST['mac']) ? 1 : 0;
$metacritic = $_POST['metacritic'] ?? null;

// Eviter les erreur de type quand poster est nul
$developerId = isset($_POST['developerId']) && $_POST['developerId'] !== '' ? (int)$_POST['developerId'] : 0;
$posterId = isset($_POST['posterId']) && $_POST['posterId'] !== '' ? (int)$_POST['posterId'] : 0;

$categories = $_POST['categories'] ?? [];
$genres = $_POST['genres'] ?? [];

if ($id === null || $id <= 0) {
    die("ID de jeu invalide.");
}

# Verifie si les champs obligatoire sont bien remplie
if (!$name || !$shortDescription || !$releaseYear || $price === null) {
    die("Certains champs obligatoires sont manquants.");
}

// Récupérer le jeu existant
$game = GameCollection::findById($id);
if (!$game) {
    die("Jeu introuvable.");
}

// Mise à jour des propriétés
$game->setName($name);
$game->setReleaseYear($releaseYear);
$game->setShortDescription($shortDescription);

// Conversion du prix en centimes
$priceInCents = (int)round($price * 100);
$game->setPrice($priceInCents);

$game->setWindows($windows);
$game->setLinux($linux);
$game->setMac($mac);

// Si la note est vide on met 0
if ($metacritic === null || $metacritic === '') {
    $game->setMetacritic(0);
} else {
    $game->setMetacritic((int)$metacritic);
}

// Developer et Poster Id
$game->setDeveloperId($developerId);
$game->setPosterId($posterId);

// Suppression des anciennes catégories puis insertion des nouvelles
Game::deleteByGameIdCat($id);
foreach ($categories as $catId) {
    Game::insertGameCategory($id, (int)$catId);
}

// Suppression des anciens genres puis insertion des nouveaux
Game::deleteByGameIdGenre($id);
foreach ($genres as $genreId) {
    Game::insertGameGenre($id, (int)$genreId);
}

// Sauvegarde finale dans la base
$game->save();

header('Location: game_modif.php?gameId=' . $id);
exit;
