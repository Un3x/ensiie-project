<?php
namespace Achievements;

class Achievements
{

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $signification;

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return Achievements
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }


    /**
     * @return string
     */
    public function getSignification()
    {
        return $this->signification;
    }

    /**
     * @param string $signification
     * @return Achievements
     */
    public function setSignification($signification)
    {
        $this->signification = $signification;
        return $this;
    }
}

