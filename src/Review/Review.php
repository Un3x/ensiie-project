<?php
namespace Review;

class Review;
    /**
     * @var string
     */
    private $id;

    /**
     * @var int
     */
    private $num;

    /**
     * @var string
     */
    private $personne;

    /**
     * @var string
     */
    private $texte;

    /**
    *@var int
    */
    private $note;

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

    /**
     * @return string
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * @param int $num
     * @return User
     */
    public function setNum($num): int
    {
        $this->num = $num;
        return $this;
    }

    /**
     * @return string
     */
    public function getPersonne()
    {
        return $this->personne;
    }

    /**
     * @param string $persenne
     * @return User
     */
    public function setPersonne($personne)
    {
        $this->personne = $personne;
        return $this;
    }

    /**
     * @return string
     */
    public function getTexte(): 
    {
        return $this->texte;
    }

    /**
     * @param string $texte
     * @return User
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;
        return $this;
    }


    /**
     * @return int
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param string $note
     * @return User
     */
    public function setNote($note)
    {
        $this->note = $note;
        return $this;
    }


}