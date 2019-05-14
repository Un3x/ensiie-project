<?php
namespace Duo;

class Duo
{

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $joueur1;

    /**
     * @var string
     */
    private $joueur2;

    /**
     * @var string
     */
    private $statut;

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param int $nom
     * @return Duo
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string
     */
    public function getJoueur1()
    {
        return $this->joueur1;
    }

    /**
     * @param string $joueur1
     * @return Duo
     */
    public function setJoueur1($joueur1)
    {
        $this->joueur1 = $joueur1;
        return $this;
    }

    /**
     * @return string
     */
    public function getJoueur2()
    {
        return $this->joueur2;
    }

    /**
     * @param string $joueur2
     * @return Duo
     */
    public function setJoueur2($joueur2)
    {
        $this->joueur2 = $joueur2;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param int $sta
     * @return Duo
     */
    public function setStatut($sta)
    {
        $this->statut = $sta;
        return $this;
    }
}

