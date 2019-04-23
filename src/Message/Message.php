<?php
namespace Message;

use DateTime;

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
     * @var datetime
     */
    private $send;

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
    public function setMember1($sender)
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
     * @return datetime
     */
    public function getSend()
    {
        return $this->send;
    }

    /**
     * @param datetime $send
     * @return Message
     */
    public function setSend($send)
    {
        $this->send = $send;
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