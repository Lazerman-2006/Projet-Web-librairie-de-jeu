<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Gender;
use PDO;

class GenderCollection
{
    public static function findByGenderId(int $genderId): array
    {
        $gender = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT id, description
            FROM genre
            WHERE genderId = :genderId
            SQL
        );
        $gender->execute(['genderId' => $genderId]);

        return $gender->fetchAll(PDO::FETCH_CLASS, Gender::class);
    }

}