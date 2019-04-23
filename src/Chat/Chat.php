<?php
namespace Chat;

use MongoDB\BSON\Timestamp;

class Chat
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $member1;

    /**
     * @var int
     */
    private $member2;

    /**
     * @var timestamp
     */
    private $startDate;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Chat
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getMember1()
    {
        return $this->member1;
    }

    /**
     * @param int $member1
     * @return Chat
     */
    public function setMember1($member1)
    {
        $this->member1 = $member1;
        return $this;
    }

    /**
     * @return int
     */
    public function getMember2()
    {
        return $this->member2;
    }

    /**
     * @param int $member2
     * @return Chat
     */
    public function setMember2($member2)
    {
        $this->member2 = $member2;
        return $this;
    }

    /**
     * @return timestamp
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param timestamp $startDate
     * @return Chat
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
        return $this;
    }
}