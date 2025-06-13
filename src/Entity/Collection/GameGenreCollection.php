<?php

namespace Entity;

use Database\MyPdo;
use PDO;

/**
 * Permet de récupérer de tout ce qui concerne la table game_genre
 */
class GameGenreCollection
{

    /**
     * Fonction qui lance une requête qui retourne tout les jeux qui font partie d'un genre via son ID
     * @param int $genreId L'id du genre utiliser pour rechercher les jeux
     * @return array Retourne l'ensemble des jeux
     */
    public static function findGameByGenreId(int $genreId, string $orderBy = 'title'): array
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
        INNER JOIN game_genre gg ON g.id = gg.gameId
        WHERE gg.genreId = :genreId
        ORDER BY $orderColumn ASC
    ");

        $stmt->execute(['genreId' => $genreId]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, Game::class);
    }


    /**
     * Permet de récupérer les id de genre avec l'id de jeux
     *
     * @param int $gameId
     * @return array
     */
    public static function findGenreIdByGameId(int $gameId): array
    {
        $category = MyPdo::getInstance()->prepare(
            <<<'SQL'
        SELECT *
        FROM genre
        WHERE id IN (
            SELECT genreid
            FROM game_genre
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
