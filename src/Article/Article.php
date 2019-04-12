<?php
namespace Article;

class Article
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $titre;

    /**
     * @var string
     */
    private $text;

    /**
     * @var \DateTimeInterface
     */
    private $date;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Article
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $firstname
     * @return Article
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
        return $this;
    }

    /**
     * @return string
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * @param string $lastname
     * @return Article
     */
    public function setTitre($texte)
    {
        $this->texte = $texte;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @param \DateTimeInterface $birthday
     * @return Article
     */
    public function setBirthday(\DateTimeInterface $date)
    {
        $this->date = $date;
        return $this;
    }


    /**
     * @return int
     * @throws \OutOfRangeException
     */
    public function joursDepuisPublication(): int
    {
        $now = new \DateTime();

        if ($now < $this->getDate()) {
            throw new \OutOfRangeException('Pas encore publié');
        }

        return $now->diff($this->getDate())->y;
    }
}

