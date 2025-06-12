<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Categorie;
use Entity\Gender;
use PDO;

/**
 * Permet de récupérer de tout ce qui concerne la table genre
 */
class GenderCollection
{
    /**
     * Cherche un genre avec un id
     *
     * @param int $genderId
     * @return array
     */


    public static function findByGenderId(int $genderId): array
    {
        $gender = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT id, description
            FROM genre
            WHERE id = :genderId
            SQL
        );
        $gender->execute(['genderId' => $genderId]);

        return $gender->fetchAll(PDO::FETCH_CLASS, Gender::class);
    }

    /**
     * Permet de récupérer tout les genres de jeux
     *
     * @return array
     */
    public static function findAllGender(): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT id,description
            FROM genre
            SQL
        );
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Gender::class);
    }

}