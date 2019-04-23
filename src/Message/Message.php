<?php
namespace Message;

use MongoDB\BSON\Timestamp;

class Message
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $sender;

    /**
     * @var int
     */
    private $chat;

    /**
     * @var timestamp
     */
    private $sendTime;

    /**
     * @var string
     */
    private $message;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Message
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param int $sender
     * @return Message
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
        return $this;
    }

    /**
     * @return int
     */
    public function getChat()
    {
        return $this->chat;
    }

    /**
     * @param int $chat
     * @return Message
     */
    public function setChat($chat)
    {
        $this->chat = $chat;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getSendTime(): \DateTimeInterface
    {
        return $this->sendTime;
    }

    /**
<<<<<<< HEAD
     * @param timestamp $send
=======
     * @param datetime $sendTime
>>>>>>> a595368e1e3da7441f27c5e7855b487397f72a10
     * @return Message
     */
    public function setSendTime(\DateTimeInterface $sendTime)
    {
        $this->sendTime = $sendTime;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return Message
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }
}