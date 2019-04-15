<?php
namespace Article;

use Membre\Membre;

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
     * @var Membre
     */
    private $auteur;

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
     * @param string $Titre
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
     * @param string $Texte
     * @return Article
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;
        return $this;
    }
    
    /**
     * @return Membre
     */
    public function getAuteur()
    {
        return $this->auteur;
    }
    
    /**
     * @param Membre $auteur
     * @return Article
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
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
     * @param \DateTimeInterface $date
     * @return Article
     */
    public function setDate(\DateTimeInterface $date)
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

