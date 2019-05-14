<?php


namespace User;


class Notation
{
    private $pseudo;
    private $note;

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function SetPseudo($pseudo) {
        $this -> pseudo=$pseudo;
    }


}