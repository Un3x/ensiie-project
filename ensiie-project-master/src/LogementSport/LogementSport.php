<?php
namespace LogementSport;

class LogementSport
{
    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $genre;

    /**
     * @var string
     */
    private $adresse;


    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }



    /**
     * @param string $nom
     * @return Logement
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
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
     * @param string $genre
     * @return Logement
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
        return $this;
    }



    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     * @return Logement
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
        return $this;
    }


}

