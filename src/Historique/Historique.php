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


    /**
     * @return \DateTimeInterface
     */
    public function getDateEmprunt()
    {
        return $this->date_emprunt;
    }

    /**
     * @param \DateTimeInterface $date_emprunt
     * @return User
     */
    public function setDateEmprunt($date_emprunt)
    {
        $this->date_emprunt = $date_emprunt;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDateRendu()
    {
        return $this->date_rendu;
    }

    /**
     * @param \DateTimeInterface $date_rendu
     * @return User
     */
    public function setDateRendu($date_rendu)
    {
        $this->date_rendu = $date_rendu;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdReview()
    {
        return $this->id_review;
    }

    /**
     * @param string $id_review
     * @return User
     */
    public function setPersonne($id_review)
    {
        $this->id_review = $id_review;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumReview(): 
    {
        return $this->num_review;
    }

    /**
     * @param string $num_review
     * @return User
     */
    public function setTexte($num_review)
    {
        $this->num_review = $num_review;
        return $this;
    }


}