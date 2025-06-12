<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Categorie;
use Entity\Game;
use PDO;

/**
 * Permet de récupérer de tout ce qui concerne la table game_category
 */
class GameCategoryCollection
{

    /**
     * Permet de récupérer les jeux avce l'id de catégories
     *
     * @param int $categorieId
     * @return array
     */
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

    /**
     * Permet de récupérer les catégories avec l'id de jeu
     *
     * @param int $gameId
     * @return array
     */
    public static function findCategoryIdByGameId(int $gameId): array
    {
        $category = MyPdo::getInstance()->prepare(
            <<<'SQL'
        SELECT *
        FROM category
        WHERE id IN (
            SELECT categoryid
            FROM game_category
            WHERE gameid IN (
                SELECT id
                FROM game
                WHERE id = :gameId
            )
        ) 
        SQL
        );

        $category->execute(['gameId' => $gameId]);

        return $category->fetchAll(PDO::FETCH_CLASS, Categorie::class);
    }


}