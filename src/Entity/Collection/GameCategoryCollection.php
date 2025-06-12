<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Game;
use PDO;

class GameCategoryCollection
{

    public static function findGameByCategoryId(int $categorieId): array
    {
        $game = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM game
            WHERE id in (SELECT gameid
                         FROM game_category
                         WHERE categoryid in (SELECT id
                                              FROM category
                                              WHERE id = :categorieId)) 
            SQL
        );
        $game->execute(['categorieId' => $categorieId]);

        return $game->fetchAll(PDO::FETCH_CLASS, Game::class);
    }

    public static function findCategoryBygameId(int $gameId): array
    {
        $game = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM category
            WHERE id in (SELECT categoryid
                         FROM game_category
                         WHERE gameId in (SELECT id
                                              FROM game
                                              WHERE id = :gameId)) 
            SQL
        );
        $game->execute(['gameId' => $gameId]);

        return $game->fetchAll(PDO::FETCH_CLASS, Game::class);
    }

}