<?php
declare(strict_types=1);

use Entity\AppWebPage;

/**
 * Cette page permet de sélectionner un id de jeu a modifier, il amène ensuite au formulaire de modification
 */
$webpage = new AppWebPage();
$webpage->setTitle("Choisir un jeu à modifier");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gameId = isset($_POST['gameId']) ? (int)$_POST['gameId'] : null;
    if ($gameId === null || $gameId <= 0) {
        $webpage->appendContent('<p style="color:red;">ID invalide, veuillez saisir un ID correct.</p>');
    } else {
        // Redirection vers game_modif.php avec le paramètre gameId en GET
        header("Location: game_modif.php?gameId=$gameId");
        exit;
    }
}

$webpage->appendContent(<<<HTML
<h1>Modifier un jeu</h1>
<form method="post" action="game_select.php">
    <label for="gameId">Entrez l'ID du jeu :</label><br>
    <input type="number" name="gameId" id="gameId" required min="1"><br><br>
    <button type="submit">Valider</button>
</form>
HTML);

echo $webpage->toHTML();
