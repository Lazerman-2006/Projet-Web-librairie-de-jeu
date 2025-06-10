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


   




}