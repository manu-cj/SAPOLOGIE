<?php
namespace App\Model\Entity;

class Character
{
    private int $id;
    private string $user_fk;
    private string $character_name;
    private string $classe;
    private string $description;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserFk(): string
    {
        return $this->user_fk;
    }

    /**
     * @param string $user_fk
     */
    public function setUserFk(string $user_fk): self
    {
        $this->user_fk = $user_fk;
        return $this;
    }

    /**
     * @return string
     */
    public function getCharacterName(): string
    {
        return $this->character_name;
    }

    /**
     * @param string $character_name
     */
    public function setCharacterName(string $character_name): self
    {
        $this->character_name = $character_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getClasse(): string
    {
        return $this->classe;
    }

    /**
     * @param string $classe
     */
    public function setClasse(string $classe): self
    {
        $this->classe = $classe;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

}