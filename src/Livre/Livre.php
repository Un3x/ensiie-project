<?php
namespace Livre;

class Livre {
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $titre;

    /**
     * @var string
     (auteurs est une clef vers des éléments de la table Auteur)
     */
    private $auteur;

    /**
     * @var \DateTimeInterface
     */
    private $publication;

    /**
    *@var string (liens vers une image)
    */
    private $image;

    /**
    *@var string
    */
    private $edition;

    /**
    *@var string
    */
    private $emprunteur;

    /**
    *@var \DateTimeInterface
    */
    private $date_emprunt;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return User
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
     * @param string $titre
     * @return Livre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * @param string $ref_auteur
     * @return Livre
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getPublication(): \DateTimeInterface
    {
        return $this->publication;
    }

    /**
     * @param \DateTimeInterface $publication
     * @return Livre
     */
    public function setPublication(\DateTimeInterface $publication)
    {
        $this->publication = $publication;
        return $this;
    }


     /**
     * @return \DateTimeInterface
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return Livre
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }


    /**
     * @return int
     * @throws \OutOfRangeException
     */
    public function getEdition()
    {
        return $this->edition;
    }

    /**
    * @param string $image
    * @return Livre
    */
    public function setEdition($edition)
    {
        $this->edition = $edition;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmprunteur()
    {
        return $this->emprunteur;
    }

    /**
    * @param string $emprunteur
    * @return Livre
    */
    public function setEmprunteur($emprunteur)
    {
        $this->emprunteur = $emprunteur;
        return $this;
    }


    /**
     * @return \DateTimeInterface
     */
    public function getDateEmprunt(): \DateTimeInterface
    {
        return $this->date_emprunt;
    }

    /**
     * @param \DateTimeInterface $date_emprunt
     * @return Livre
     */
    public function setPublication(\DateTimeInterface $date_emprunt)
    {
        $this->date_emprunt = $date_emprunt;
        return $this;
    }
    
}