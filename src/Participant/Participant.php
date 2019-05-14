<?php
namespace Participant;

class Participant
{
    /**
     * @var string
     */
    private $id_eleve;

    /**
     * @var integer
     */
    private $id_forum;

    /**
     * @return int
     */
    public function getIdEleve()
    {
        return $this->id_eleve;
    }

    /**
     * @param int $id_eleve
     * @return Participant
     */
    public function setIdEleve($id_eleve)
    {
        $this->id_eleve = $id_eleve;
        return $this;
    }

    /**
     * @return integer
     */
    public function getIdForum()
    {
        return $this->id_forum;
    }

    /**
     * @param integer $id_forum
     * @return Participant
     */
    public function setIdForum($id_forum)
    {
        $this->id_forum = $id_forum;
        return $this;
    }

}

