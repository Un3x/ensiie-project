<?php
namespace Chatroom;

use MongoDB\BSON\Timestamp;

class Chatroom
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $chatRoomName;

    /**
     * @var int
     */
    private $member;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Chatroom
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
     * @return \DateTimeInterface
     */
    public function getStartDate(): \DateTimeInterface
    {
        return $this->startDate;
    }

    /**
     * @param \DateTimeInterface $startDate
     * @return Chat
     */
    public function setStartDate(\DateTimeInterface $startDate)
    {
        $this->startDate = $startDate;
        return $this;
    }
}