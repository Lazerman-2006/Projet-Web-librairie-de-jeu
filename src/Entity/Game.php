<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;

/**
 * Class Game qui représente un jeu vidéo.
 */
class Game
{
    private int $id = 0;
    private string $name = "";
    private int $releaseYear = 0;
    private string $shortDescription = "";
    private int $price = 0;
    private int $windows = 0;
    private int $linux = 0;
    private int $mac = 0;
    private ?int $metacritic = null;
    private ?int $developerId = null;
    private ?int $posterId = null;

    /**
     * Permet d'obtenir l'identifiant du jeu.
     * @return int Retourne l'id du jeu.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Permet de définir l'identifiant du jeu.
     * @param int $id L'id à définir.
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Permet d'obtenir le nom du jeu.
     * @return string Le nom du jeu.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Permet de définir le nom du jeu.
     * @param string $name Le nom à définir.
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Permet d'obtenir l'année de sortie du jeu.
     * @return int L'année de sortie.
     */
    public function getReleaseYear(): int
    {
        return $this->releaseYear;
    }

    /**
     * Permet de définir l'année de sortie du jeu.
     * @param int $releaseYear L'année à définir.
     * @return void
     */
    public function setReleaseYear(int $releaseYear): void
    {
        $this->releaseYear = $releaseYear;
    }

    /**
     * Permet d'obtenir la description du jeu.
     * @return string La description courte.
     */
    public function getShortDescription(): string
    {
        return $this->shortDescription;
    }

    /**
     * Permet de définir la description du jeu.
     * @param string $shortDescription La description à définir.
     * @return void
     */
    public function setShortDescription(string $shortDescription): void
    {
        $this->shortDescription = $shortDescription;
    }

    /**
     * Permet d'obtenir le prix du jeu.
     * @return int Le prix du jeu.
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * Permet de définir le prix du jeu.
     * @param int $price Le prix à définir.
     * @return void
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * Indique si le jeu est compatible Windows.
     * @return bool Vrai si compatible Windows, faux sinon.
     */
    public function isWindows(): int
    {
        return $this->windows;
    }

    /**
     * Définit la compatibilité Windows.
     * @param bool $windows Vrai si compatible, faux sinon.
     * @return void
     */
    public function setWindows(int $windows): void
    {
        $this->windows = $windows;
    }

    /**
     * Indique si le jeu est compatible Linux.
     * @return bool Vrai si compatible Linux, faux sinon.
     */
    public function isLinux(): int
    {
        return $this->linux;
    }

    /**
     * Définit la compatibilité Linux.
     * @param bool $linux Vrai si compatible, faux sinon.
     * @return void
     */
    public function setLinux(int $linux): void
    {
        $this->linux = $linux;
    }

    /**
     * Indique si le jeu est compatible Mac.
     * @return bool Vrai si compatible Mac, faux sinon.
     */
    public function isMac(): int
    {
        return $this->mac;
    }

    /**
     * Définit la compatibilité Mac.
     * @param bool $mac Vrai si compatible, faux sinon.
     * @return void
     */
    public function setMac(int $mac): void
    {
        $this->mac = $mac;
    }

    /**
     * Permet d'obtenir la note Metacritic du jeu.
     * @return int La note Metacritic.
     */
    public function getMetacritic(): ?int
    {
        return $this->metacritic;
    }

    /**
     * Permet de définir la note Metacritic.
     * @param int $metacritic La note à définir.
     * @return void
     */
    public function setMetacritic(int $metacritic): void
    {
        $this->metacritic = $metacritic;
    }

    /**
     * Permet d'obtenir l'identifiant du développeur.
     * @return int L'id du développeur.
     */
    public function getDeveloperId(): int
    {
        return $this->developerId;
    }

    /**
     * Permet de définir l'identifiant du développeur.
     * @param int $developerId L'id à définir.
     * @return void
     */
    public function setDeveloperId(int $developerId): void
    {
        $this->developerId = $developerId;
    }

    /**
     * Permet d'obtenir l'identifiant de l'affiche.
     * @return int L'id de l'affiche.
     */
    public function getPosterId(): int
    {
        return $this->posterId;
    }

    /**
     * Permet de définir l'identifiant de l'affiche.
     * @param int $posterId L'id à définir.
     * @return void
     */
    public function setPosterId(int $posterId): void
    {
        $this->posterId = $posterId;
    }


    /**
     * Cette fonction permet de supprimer la ligne d'un jeu sur la base de données
     *
     * @return void
     */
    public function delete(): void
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<SQL
        DELETE FROM game
        WHERE id = :id
        SQL
        );
        $stmt->execute([':id' => $this->id]);
    }


    /**
     *
     * Permet de rajouter un jeu
     *
     * @param int $id
     * @param string $name
     * @param int $releaseYear
     * @param string $shortDescription
     * @param int $price
     * @param bool $windows
     * @param bool $linux
     * @param bool $mac
     * @param int|null $metacritic
     * @param int|null $developerId
     * @param int|null $posterId
     * @return void
     */
    public function insertGame(int $id ,string $name,int $releaseYear,string $shortDescription,int $price,bool $windows,bool $linux,bool $mac,?int $metacritic,?int $developerId,?int $posterId): void
    {
        $game = MyPdo::getInstance()->prepare(
            <<<SQL
            INSERT INTO game
            VALUES (:id,:name,:releaseyear,:shortdescription,:price,:windows,:linux,:mac,:metacritic,:developerId,:posterId)
            SQL
        );
        $game->execute(['id' => $id,'name' => $name,'releaseyear' => $releaseYear,'shortdescription' => $shortDescription,'price' => $price,'windows' => $windows,'linux' => $linux,'mac' => $mac,'metacritic' => $metacritic,'developerid' => $developerId,'posterid' => $posterId]);

    }

    /**
     * Permet de mettre à jour la page d'un jeu
     *
     * @return void
     */
    public function updateGame(): void
    {

    }





}
