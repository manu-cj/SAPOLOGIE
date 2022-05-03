<?php
namespace App\Model\Entity;

class Comment
{
    private int $id;
    private int $user_fk;
    private string $content;
    private \DateTime $date;
    private int $character_image_fk;

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
     * @return int
     */
    public function getUserFk(): int
    {
        return $this->user_fk;
    }

    /**
     * @param int $user_fk
     */
    public function setUserFk(int $user_fk): self
    {
        $this->user_fk = $user_fk;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date): self
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return int
     */
    public function getCharacterImageFk(): int
    {
        return $this->character_image_fk;
    }

    /**
     * @param int $character_image_fk
     */
    public function setCharacterImageFk(int $character_image_fk): self
    {
        $this->character_image_fk = $character_image_fk;
        return $this;
    }

}