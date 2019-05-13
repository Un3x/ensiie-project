<?php
namespace Sport;

class Sport
{
    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $lieu;

   /**
     * @var char
     */
    private $genre;


    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return Sport
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }


    /**
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param string $sport
     * @return Sport
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
        return $this;
    }


    /**
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param char $genre
     * @return Sport
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
        return $this;
    }


}

