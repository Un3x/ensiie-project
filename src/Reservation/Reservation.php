<?php
namespace Reservation;

class Reservation {
    /**
     * @var string
     */
    private $id_livre;

    /**
     * @var string
     */
    private $id_user;

    
    /**
     * @return string
     */
    public function getIdLivre()
    {
        return $this->id_livre;
    }

    /**
     * @param string $id_livre
     * @return Reservation
     */
    public function setIdLivre($id_livre)
    {
        $this->id_livre = $id_livre;
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
     * @param string $id_user
     * @return Historique
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
        return $this;
    }


}