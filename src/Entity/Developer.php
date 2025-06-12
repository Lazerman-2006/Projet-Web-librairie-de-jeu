<?php

declare(strict_types=1);

namespace Entity;
use Database\MyPdo;
use PDO;

/**
 * Class Developer qui représente les developer des jeux vidéos
 */
class Developer
{
    private int $id;
    private string $name;

    /** Permet d'avoir l'id d'un developer
     * @return int Retourne l'id de l'objet
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Permet de définir un id d'un developer
     * @param int $id ID que l'on souhaite ajouter
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


    /** Permet d'avoir le nom d'un developer
     * @return string Retourne le nom de l'objet
     */
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * Permet de définir le nom d'un developer
     * @param string $name Le nom que l'on souhaite modifié
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public static function findById(int $id): ?Developer
    {
        $dev = MyPdo::getInstance()->prepare(
            <<<SQL
        SELECT id, name
        FROM developer
        WHERE id = :id
        SQL
        );
        $dev->execute([':id' => $id]);

        $dev->setFetchMode(PDO::FETCH_CLASS, Developer::class);
        return $dev->fetch() ?: null;
    }





}
