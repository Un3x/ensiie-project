<?php
namespace CommentCarrier;

class CommentCarrier
{
    /**
     * @var int
     */
    private $id_comment_carrier;

    /**
     * @var int
     * Id of the customer
     */
    private $carrier;

    /**
     * @var string
     */
    private $content;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id_comment_carrier;
    }

    public function setId($id)
    {   
        $this->id_comment_carrier = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * @param int $carrier
     * @return Comment
     */
    public function setCustomer($carrier)
    {
        $this->carrier = $carrier;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

}