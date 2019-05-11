<?php
namespace CommentCustomer;

class CommentCustomer
{
    /**
     * @var int
     */
    private $id_comment_customer;

    /**
     * @var int
     * Id of the customer
     */
    private $customer;

    /**
     * @var string
     */
    private $content;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id_comment_customer;
    }

    public function setId($id)
    {   
        $this->id_comment_customer = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomer()
    {
        return $this->departure;
    }

    /**
     * @param int $customer
     * @return Comment
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
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