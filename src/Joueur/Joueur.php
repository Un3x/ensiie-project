<?php
namespace Joueur;

class Joueur
{
    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $rang;

    /**
     * @var int
     */
    private $promotion;

    /**
     * @var int
     */
    private $password;    


    /**
     * @return varchar
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param varchar $nom
     * @return Joueur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string
     */
    public function getRang()
    {
        return $this->rang;
    }

    /**
     * @param string $rang
     * @return Joueur
     */
    public function setRang($rang)
    {
        $this->rang = $rang;
        return $this;
    }

    /**
     * @return int
     */
    public function getPromotion()
    {
        return $this->promotion;
    }

    /**
     * @param int $prom
     * @return Joueur
     */
    public function setPromotion($prom)
    {
        $this->promotion = $prom;
        return $this;
    }

    /**
     * @return int
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param int $prom
     * @return Joueur
     */
    public function setPassword($p)
    {
        $this->password = $p;
        return $this;
    }    

}

