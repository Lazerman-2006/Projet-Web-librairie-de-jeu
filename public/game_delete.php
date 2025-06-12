<?php

declare(strict_types=1);

use Html\WebPage;
use Entity\Collection\GameCollection;
use Entity\Game;

$webpage = new WebPage("Supprimer un jeu");

$gameId = (int) $_POST['gameId'];
if ($gameId===Null)
{
    $games = GameCollection::findAllGame();

    $webpage->appendContent("<form method='POST' action='game_delete.php'>");
    $webpage->appendContent("<select name='gameId'>");
    $webpage->appendContent("<option value=''>Choissisé un jeux à supprimer</option>");
    foreach ($games as $game)
    {
        $webpage->appendContent("<option value='{$game->getId()}'>{$game->getName()}</option>");
    }
    $webpage->appendContent("</select>");
    $webpage->appendContent("</form>");
}
else
{
    Game::deleteGame($gameId);
    $webpage->appendContent("<p>Jeux supprimé avec succès</p>");
    $webpage->appendContent("<a href=index.php>Revenir à la page d'acceuil</a>");
}




