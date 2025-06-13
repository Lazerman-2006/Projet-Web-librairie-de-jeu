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
    public static function findGameByCategoryId(int $categoryId, string $orderBy = 'title'): array
    {
        // Vérifier l'ordre demandé
        $allowedOrders = ['title', 'year'];
        if (!in_array($orderBy, $allowedOrders)) {
            $orderBy = 'title';
        }

        // Déterminer la colonne à utiliser
        $orderColumn = ($orderBy === 'year') ? 'g.releaseYear' : 'g.name'; // Remplace `release_date` par le vrai nom

        // Construire la requête avec la colonne correcte
        $stmt = MyPdo::getInstance()->prepare("
        SELECT g.*
        FROM game g
        INNER JOIN game_category gg ON g.id = gg.gameId
        WHERE gg.categoryId = :categoryId
        ORDER BY $orderColumn ASC
    ");

        $stmt->execute(['categoryId' => $categoryId]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, Game::class);
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