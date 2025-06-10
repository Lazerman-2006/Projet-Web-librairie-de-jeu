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
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT g.*
            FROM game g
            INNER JOIN game_category cat
            ON g.id = cat.categoryId
            WHERE cat.categoryId = :categorieId
            SQL
        );
        $stmt->execute(['categorieId' => $categorieId]);

        return $stmt->fetchAll(PDO::FETCH_CLASS, Game::class);
    }

}