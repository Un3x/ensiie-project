<?php


namespace User;


class Commentaire
{
    private $pseudo;
    private $commentaire;
    private $commentateur;
    private $dat;
    private $heur;

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setPseudo($pseudo) {
        $this -> pseudo=$pseudo;
        return $this;
    }

    public function getCommentaire()
    {
        return $this->commentaire;

    }

    public function setCommentaire($commentaire) {
        $this ->commentaire =$commentaire;
        return $this;
    }

    public function getCommentateur()
    {
        return $this->commentateur;
    }

    public function setCommentateur($commentateur) {
        $this -> commentateur=$commentateur;
        return $this;
    }

    public function getDat()
    {
        return $this->dat;
    }

    public function setDat($dat) {
        $this -> dat=$dat;
        return $this;
    }

    public function getHeur()
    {
        return $this->heur;
    }

    public function setHeur($heur) {
        $this ->heur=$heur;
        return $this;
    }

}