<?php
declare(strict_types=1);

use Entity\AppWebPage;
use Entity\Game;
use Entity\Exception\ParameterException;

$webpage = new AppWebPage();
$webpage->setTitle("Création du jeu");

try {
    // Vérifie les champs obligatoires
    $requiredFields = ['id', 'name', 'releaseYear', 'shortDescription', 'price'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            throw new ParameterException("Le champ '$field' est obligatoire.");
        }
    }

    // Récupération des données du formulaire
    $id = (int) $_POST['id'];
    $name = trim($_POST['name']);
    $releaseYear = (int) $_POST['releaseYear'];
    $shortDescription = trim($_POST['shortDescription']);
    $price = (int) $_POST['price'];

    $windows = isset($_POST['windows']) ? 1 : 0;
    $linux = isset($_POST['linux']) ? 1 : 0;
    $mac = isset($_POST['mac']) ? 1 : 0;

    $metacritic = $_POST['metacritic'] !== '' ? (int) $_POST['metacritic'] : null;
    $developerId = $_POST['developerId'] !== '' ? (int) $_POST['developerId'] : null;
    $posterId = $_POST['posterId'] !== '' ? (int) $_POST['posterId'] : null;

    // Création du jeu
    $game = new Game();
    $game->insertGame(
        $id,
        $name,
        $releaseYear,
        $shortDescription,
        $price,
        $windows,
        $linux,
        $mac,
        $metacritic,
        $developerId,
        $posterId
    );

    // Récupérer les catégories et genres cochés (tableaux ou tableaux vides)
    $categories = $_POST['categories'] ?? [];
    $genres = $_POST['genres'] ?? [];

    // Insérer les liens jeu <-> catégories
    foreach ($categories as $catId) {
        $catId = (int) $catId;
        $game->insertGameCategory($id, $catId); // <-- méthode à implémenter
    }

    // Insérer les liens jeu <-> genres
    foreach ($genres as $genreId) {
        $genreId = (int) $genreId;
        $game->insertGameGenre($id, $genreId); // <-- méthode à implémenter
    }

    // Message de succès
    $webpage->appendContent("<h2>Le jeu \"$name\" a été ajouté avec succès.</h2>");
    $webpage->appendContent("<a href=\"../index.php\"><button>Retour à l'accueil</button></a>");

} catch (ParameterException $e) {
    $webpage->appendContent("<p style='color:red;'>Erreur : {$e->getMessage()}</p>");
    $webpage->appendContent("<a href=\"game_add.php\"><button>Retour au formulaire</button></a>");
} catch (Throwable $e) {
    $webpage->appendContent("<p style='color:red;'>Une erreur est survenue : {$e->getMessage()}</p>");
    $webpage->appendContent("<a href=\"game_add.php\"><button>Retour au formulaire</button></a>");
}

echo $webpage->toHTML();
