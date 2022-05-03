<?php
namespace App\Model\Entity;

class Character_image
{
    private string $image;
    private string $character_fk;
    private string $user_fk;
    private int $view_fk;
    private string $description;

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
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return string
     */
    public function getCharacterFk(): string
    {
        return $this->character_fk;
    }

    /**
     * @param string $character_fk
     */
    public function setCharacterFk(string $character_fk): self
    {
        $this->character_fk = $character_fk;
        return $this;
    }

    /**
     * @return int
     */
    public function getViewFk(): int
    {
        return $this->view_fk;
    }

    /**
     * @param int $view_fk
     */
    public function setViewFk(int $view_fk): self
    {
        $this->view_fk = $view_fk;
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