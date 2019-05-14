<?php
namespace Participant;

class Participant
{

    private $key;

    private $idevent;

    private $iduser;

    private $pseudo;

    public function getKey()
    {
        return $this->key;
    }

    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    public function getIdEvent()
    {
        return $this->idevent;
    }


    public function setIdEvent($idevent)
    {
        $this->idevent = $idevent;
        return $this;
    }

    public function getIdUser()
    {
        return $this->iduser;
    }

    public function setIdUser($iduser)
    {
        $this->iduser = $iduser;
        return $this;
    }    

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
        return $this;
    }

}

