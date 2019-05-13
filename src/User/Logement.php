<?php
namespace Logement;

class Logement
{
    /**
     * @var int
     */
    private $idLogement;

    /**
     * @var int
     */
    private $iduser;

    /**
     * @var int
     */
    private $departement;

    /**
     * @var varchar not null
     */
    private $ville;

    /**
     * @var int
     */
    private nb_places_libres;

    /**
     * @var int
     */
    private prix;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->idLogement;
    }

    /**
     * @param int $id
     * @return Logement
     */
    public function setId($id)
    {
        $this->idLogement = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getUser()
    {
        return $this->iduser;
    }

    /**
     * @param int $user
     * @return Logement
     */
    public function setId($user)
    {
        $this->iduser = $user;
        return $this;
    }

    /**
     * @return int
     */
    public function getDep()
    {
        return $this->departement;
    }

    /**
     * @param int $dep
     * @return Logement
     */
    public function setDep($dep)
    {
        $this->idLogement = $dep;
        return $this;
    }

    /**
     * @return varchar
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param varchar $ville 
     * @return Logement
     */
    public function ($ville)
    {
        $this->ville = $ville;
        return $this;
    }


    /**
     * @return int
     */
    public function getNbPlaces()
    {
        return $this->nb_places_libres;
    }

    /**
     * @param int $NPL 
     * @return Logement
     */
    public function ($NPL)
    {
        $this->nb_places_libres = $NPL;
        return $this;
    }




     /**
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param int $prix 
     * @return Logement
     */
    public function ($prix)
    {
        $this->prix = $prix;
        return $this;
    }


}
