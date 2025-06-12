<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Categorie;
use Entity\Game;
use PDO;

class GameCollection
{
    public static function findByGameId(int $gameId): Game
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT id,name,releaseYear,shortDescription,price,windows,linux,mac,metacritic,developerId,posterId
            FROM game
            WHERE id = :gameId
            SQL
        );
        $stmt->execute(['gameId' => $gameId]);

        return $stmt->fetchAll(PDO::FETCH_CLASS, Game::class);
    }

    public static function findAllGame(): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT id,name,releaseYear,shortDescription,price,windows,linux,mac,metacritic,developerId,posterId
            FROM game
            SQL
        );
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Game::class);
    }

}