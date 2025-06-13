<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Categorie;
use Entity\Game;
use PDO;

/**
 * Gère tout ce qui concerne la table game
 */
class GameCollection
{
    /**
     * Permet de récupérer un jeu à partir de l'id
     *
     * @param int $gameId
     * @return Game
     */
    public static function findByGameId(int $gameId): Array
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

    /**
     * Permet de récupérer la totalité des jeux
     *
     * @return array
     */
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