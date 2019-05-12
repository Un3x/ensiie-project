<?php
namespace User;

class Message
{
    private $id_mess;
    private $titre;
    private $contenu;
    private $mail;
    private $valid;

    public function getId()
    {
        return $this->id_mess;
    }

    public function setId($id)
    {
        $this->id_mess = $id;
        return $this;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($tit)
    {
        $this->titre = $tit;
        return $this;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function setContenu($cont)
    {
        $this->contenu=$cont;
        return $this;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($mail)
    {
        $this->mail=$mail;
        return $this;
    }

    public function getValid()
    {
        return $this->valid;
    }

    public function setValid($v)
    {
        $this->valid=$v;
        return $this;
    }

}

?>