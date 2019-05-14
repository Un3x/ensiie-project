<?php
namespace Tournoi;

class Tournoi
{
    /**
     * @var varchar
     */
    private $nom;

    /**
     * @var date
     */
    private $date_debut;


    /**
     * @return varchar
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param varchar $nom
     * @return Tournoi
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }


    /**
     * @return date
     */
    public function getDate_debut()
    {
        return $this->date_debut;
    }

    /**
     * @param date $date_debut
     * @return Tournoi
     */
    public function setDate_debut($date_debut)
    {
        $this->date_debut = $date_debut;
        return $this;
    }
}

