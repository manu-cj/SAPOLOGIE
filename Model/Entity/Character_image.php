<?php
namespace App\Model\Entity;

class Character_image
{
    private int $id;
    private string $image;
    private string $character_fk;

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

}