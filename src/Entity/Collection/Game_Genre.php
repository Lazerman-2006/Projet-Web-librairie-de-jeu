<?php

namespace Entity;

use Database\MyPdo;
use PDO;

class Game_Genre
{

    /**
     * Fonction qui lance une requête qui retourne tout les jeux qui font partie d'un genre via son ID
     * @param int $genreId L'id du genre utiliser pour rechercher les jeux
     * @return array Retourne l'ensemble des jeux
     */
    public static function findGameByGenreId(int $genreId): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT g.*
            FROM game g
            INNER JOIN game_genre gg ON g.id = gg.gameId
            WHERE gg.genreId = :genreId
            SQL
        );
        $stmt->execute(['genreId' => $genreId]);

        return $stmt->fetchAll(PDO::FETCH_CLASS, Game::class);
    }
}
