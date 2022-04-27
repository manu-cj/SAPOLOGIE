<?php
namespace App\Model\Entity;

class Messages
{
    private int $id;
    private string $author_fk;
    private string $content;
    private string $destinataire;
    private \DateTime $date;

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
    public function getAuthorFk(): string
    {
        return $this->author_fk;
    }

    /**
     * @param string $author_fk
     */
    public function setAuthorFk(string $author_fk): self
    {
        $this->author_fk = $author_fk;
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
     * @return string
     */
    public function getDestinataire(): string
    {
        return $this->destinataire;
    }

    /**
     * @param string $destinataire
     */
    public function setDestinataire(string $destinataire): self
    {
        $this->destinataire = $destinataire;
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

}