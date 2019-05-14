<?php
namespace Matchs;

class Matchs
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $score1;

    /**
     * @var int
     */
    private $score2;

    /**
     * @var int
     */
    private $participant1;

    /**
     * @var int
     */
    private $participant2;

    /**
     * @var int
     */
    private $tournoi;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Matchs
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }


    /**
     * @return int
     */
    public function getScore1()
    {
        return $this->score1;
    }

    /**
     * @param int $s
     * @return Matchs
     */
    public function setScore1($s)
    {
        $this->score1 = $s;
        return $this;
    }


    /**
     * @return int
     */
    public function getScore2()
    {
        return $this->score2;
    }

    /**
     * @param int $s
     * @return Matchs
     */
    public function setScore2($s)
    {
        $this->score2 = $s;
        return $this;
    }


    /**
     * @return int
     */
    public function getParticipant1()
    {
        return $this->participant1;
    }

    /**
     * @param int $j
     * @return Matchs
     */
    public function setParticipant1($p)
    {
        $this->participant1 = $p;
        return $this;
    }


    /**
     * @return int
     */
    public function getParticipant2()
    {
        return $this->participant2;
    }

    /**
     * @param int $j
     * @return Matchs
     */
    public function setParticipant2($p)
    {
        $this->participant2 = $p;
        return $this;
    }


    /**
     * @return int
     */
    public function getTournoi()
    {
        return $this->tournoi;
    }

    /**
     * @param int $tournoi
     * @return Matchs
     */
    public function setTournoi($tournoi)
    {
        $this->tournoi = $tournoi;
        return $this;
    }
}

