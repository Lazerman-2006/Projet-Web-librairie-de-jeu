<?php

namespace Entity;

use Database\MyPdo;
use Entity\Categorie;
use PDO;

/**
 * CategorieCollection qui permet d'extraire des données de la class Categorie
 */
class CategorieCollection
{
    /**
     * Permet de trouver une catégorie via son ID
     * @param int $categorieId Id de la catégorie
     * @return array Retourne la catégorie
     */
    public static function findByCategorieId(int $categorieId): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT id,description
            FROM categorie
            WHERE id = :categorieId
            SQL
        );
        $stmt->execute(['categorieId' => $categorieId]);

        return $stmt->fetchAll(PDO::FETCH_CLASS, Categorie::class);
    }

    public static function findAllCategorie(): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT id,description
            FROM categorie
            SQL
        );
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Categorie::class);
    }
}