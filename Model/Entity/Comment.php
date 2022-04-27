<?php
namespace App\Model\Entity;

class Comment
{
    private int $id;
    private string $username;
    private string $content;
    private \DateTime $date;
    private string $character_image_fk;

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
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;
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
     * @return string
     */
    public function getCharacterImageFk(): string
    {
        return $this->character_image_fk;
    }

    /**
     * @param string $character_image_fk
     */
    public function setCharacterImageFk(string $character_image_fk): self
    {
        $this->character_image_fk = $character_image_fk;
        return $this;
    }

}