<?php

declare(strict_types=1);

namespace Entity;

/**
 * Class Game qui représente un jeu vidéo.
 */
class Game
{
    private int $id;
    private string $name;
    private int $releaseYear;
    private string $shortDescription;
    private int $price;
    private bool $windows;
    private bool $linux;
    private bool $mac;
    private int $metacritic;
    private int $developerId;
    private int $posterId;

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
    public function isWindows(): bool
    {
        return $this->windows;
    }

    /**
     * Définit la compatibilité Windows.
     * @param bool $windows Vrai si compatible, faux sinon.
     * @return void
     */
    public function setWindows(bool $windows): void
    {
        $this->windows = $windows;
    }

    /**
     * Indique si le jeu est compatible Linux.
     * @return bool Vrai si compatible Linux, faux sinon.
     */
    public function isLinux(): bool
    {
        return $this->linux;
    }

    /**
     * Définit la compatibilité Linux.
     * @param bool $linux Vrai si compatible, faux sinon.
     * @return void
     */
    public function setLinux(bool $linux): void
    {
        $this->linux = $linux;
    }

    /**
     * Indique si le jeu est compatible Mac.
     * @return bool Vrai si compatible Mac, faux sinon.
     */
    public function isMac(): bool
    {
        return $this->mac;
    }

    /**
     * Définit la compatibilité Mac.
     * @param bool $mac Vrai si compatible, faux sinon.
     * @return void
     */
    public function setMac(bool $mac): void
    {
        $this->mac = $mac;
    }

    /**
     * Permet d'obtenir la note Metacritic du jeu.
     * @return int La note Metacritic.
     */
    public function getMetacritic(): int
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
}
