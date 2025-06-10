<?php

declare(strict_types=1);

namespace Entity;

class Gender
{

    private int $id;

    private string $description;


    /**
     * Get id from Gender object
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Update id on Gender object
     *
     * @param int $id
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Get description from Gender object
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }


    /**
     * Update description on Gender object
     *
     * @param string $description
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }



}