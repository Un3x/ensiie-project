<?php
namespace Livre;

class Livre;
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $titre;

    /**
     * @var string[]
     */
    private $auteurs;

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
    private $edition

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
     * @param string $firstname
     * @return User
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getAuteurs()
    {//TODO ALED le multivalué au secours
        res=
        return $this->;
    }

    /**
     * @param string $lastname
     * @return User
     */
    public function setAuteurs($auteurs)
    {
        $this->auteurs = $auteurs;
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
     * @return User
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
     * @return User
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
    * @return User
    */
    public function setEdition($edition)
    {
        $this->edition = $edition;
        return $this;
    }



}