<?php
namespace Empruntes;

class Empruntes;
    /**
     * @var string
     */
    private $id;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }



}