<?php
namespace Score;

class Score
{
    /**
     * @var string
     */
    private $participant;

    /**
     * @var string
     */
    private $tournoi;

    /**
     * @var int
     */
    private $score;


    /**
     * @return varchar
     */
    public function getParticipant()
    {
        return $this->participant;
    }

    /**
     * @param varchar $participant
     * @return Joueur
     */
    public function setParticipant($participant)
    {
        $this->participant = $participant;
        return $this;
    }

    /**
     * @return string
     */
    public function getTournoi()
    {
        return $this->tournoi;
    }

    /**
     * @param string $tournoi
     * @return Joueur
     */
    public function setTournoi($tournoi)
    {
        $this->tournoi = $tournoi;
        return $this;
    }

    /**
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param int $score
     * @return Joueur
     */
    public function setScore($score)
    {
        $this->score = $score;
        return $this;
    }
}

