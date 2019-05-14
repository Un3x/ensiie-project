<?php


namespace User;


class Identite
{
    /**
     * @var int
     */
    private $id;
    /*
     * @var string;
     * */
    private $pseudo;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $prenom;

    /**
     * @var \string;
     */
    private $sexe;
    /**
     * @var \string;
     */
    private $phrase;
    /**
     * @var \string;
     */
    private $region;
    /**
     * @var \string;
     */
    private $ville;

    private $note;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**

     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     *

     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
        return $this;
    }

    /**

     */
    public function getNom()
    {
        return $this->nom;
    }

    /**

     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }


    public function getSexe()
    {
        return $this->sexe;
    }

    public function SetSexe($sexe) {
        $this -> sexe=$sexe;
        return $this;
    }

    public function getVille()
    {
        return $this->ville;
    }

    public function SetVille($ville) {
        $this -> ville=$ville;
        return $this;
    }


    public function getRegion()
    {
        return $this->region;
    }

    public function SetRegion($region) {
        $this ->region =$region;
        return $this;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function SetPrenom ($prenom) {
        $this ->prenom=$prenom;
        return $this;
    }

    public function getNote()
    {
        return $this->note;
    }

    public function setNote($note) {
        $this ->note =$note;
        return $this;
    }

    public function getPhrase()
    {
        return $this->phrase;
    }

    public function SetPhrase($phrase) {
        $this -> phrase=$phrase;
        return $this;
    }

}
?>