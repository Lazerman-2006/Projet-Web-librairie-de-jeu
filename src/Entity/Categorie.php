<?php

declare(strict_types=1);

namespace Entity;
use Database\MyPdo;
use PDO;

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

    /**
     * Récupère la description d'une catégorie à parti de son id
     *
     * @param int $catId
     * @return string
     */
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

    /**
     * Permet de récupérer des catégories à parit de lid d'un jeux
     *
     * @param int $gameId
     * @return array
     */
    public static function findByGameId(int $gameId): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<SQL
        SELECT c.id, c.description
        FROM category c
        JOIN game_category gc ON gc.category_id = c.id
        WHERE gc.game_id = :gameId
        SQL
        );
        $stmt->execute(['gameId' => $gameId]);

        return $stmt->fetchAll(PDO::FETCH_CLASS, Categorie::class);
    }




}
