<?php
namespace Participants;

class Participants
{
    /**
     * @var string
     */
    public $nom;

    /**
     * @var int
     */
    private $elo;

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return Participant
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return int
     */
    public function getElo()
    {
        return $this->elo;
    }

    /**
     * @param int $elo
     * @return Participant
     */
    public function setElo($elo)
    {
        $this->elo = $elo;
        return $this;
    }

}

