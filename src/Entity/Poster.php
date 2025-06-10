<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use PDO;

class Poster
{
    private int $id;

    private string $jpeg;


    /**
     * Récupère l'id d'un Poster
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Récupère le jpeg d'un Poster
     *
     * @return string
     */
    public function getJpeg(): string
    {
        return $this->jpeg;
    }


    /**
     * Récupère un objet Poster avec un id
     *
     * @param int $id
     * @return Poster
     */
    public static function findById(int $id): Poster
    {
        $poster = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT id, jpeg
            FROM cover
            WHERE id = :id
            SQL
        );
        $poster->execute([':id' => $id]);

        $poster->setFetchMode(PDO::FETCH_CLASS, Poster::class);
        $poster_return = $poster->fetch();

        return $poster_return;
    }




}