<?php

declare(strict_types=1);

namespace Entity;
use Database\MyPdo;

/**
 * Class catégorie qui représente les catégories des jeux vidéos
 */
class Categorie
{
    private int $id;
    private string $description;

    /**
     * @return int Retourne l'id de l'objet Catégorie
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Permet de définir un id d'un objet
     * @param int $id ID que l'on souhaite ajouter
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


    /**
     * @return string Retourne la description de l'objet Catégorie
     */
    public function getDescription(): string
    {
        return $this->description;
    }


    /**
     * Permet de définir la description d'un objet
     * @param string $description
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public static function findDescById(int $catId): string
    {
        $gender = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT description
            FROM category
            WHERE id = :categoryId
            SQL
        );
        $gender->execute(['categoryId' => $catId]);

        return $gender->fetchColumn();
    }



}
