<?php
namespace Achievements_participants;

class Achievements_participants
{
    /**
     * @var string
     */
    private $participant;

    /**
     * @var string
     */
    private $succes;

    /**
     * @return string
     */
    public function getParticipant()
    {
        return $this->participant;
    }

    /**
     * @param string $par
     * @return Achievements_participants
     */
    public function setParticipant($par)
    {
        $this->participant = $par;
        return $this;
    }

    /**
     * @return string
     */
    public function getSucces()
    {
        return $this->succes;
    }

    /**
     * @param string $suc
     * @return Achievements_participants
     */
    public function setSucces($suc)
    {
        $this->succes = $suc;
        return $this;
    }
}

