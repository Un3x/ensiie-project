<?php
namespace Historique;

class Historique;
    /**
     * @var string
     */
    private $id_livre;

    /**
     * @var string
     */
    private $id_user;

    /**
     * @var \DateTimeInterface
     */
    private $date_emprunt;

    /**
     * @var \DateTimeInterface
     */
    private $date_rendu;

    /**
     * @var string
     */
    private $id_review;

    /**
     * @var string
     */
    private $num_review;

    /**
     * @return string
     */
    public function getIdLivre()
    {
        return $this->id_livre;
    }

    /**
     * @param string $id
     * @return User
     */
    public function setIdLivre($id)
    {
        $this->id_livre = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param string $id
     * @return User
     */
    public function setIdUser($id)
    {
        $this->id_user = $id;
        return $this;
    }


//TODO la suite
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