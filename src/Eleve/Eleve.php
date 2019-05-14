<?php
namespace Eleve;

class Eleve
{
    /**
     * @var int
     */
    private $id_eleve;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $prenom;

    /**
     * @var integer
     */
    private $grade;

    /**
     * @var string
     */
    private $mdp;

    /**
     * @var statut
     */
    private $stat;

    /**
     * @var string
     */
    private $mail;

    /**
     * @return int
     */
    public function getIdEleve()
    {
        return $this->id_eleve;
    }

    /**
     * @param int $id_eleve
     * @return User
     */
    public function setIdEleve($id_eleve)
    {
        $this->id_eleve = $id_eleve;
        return $this;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return Eleve
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     * @return Eleve
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * @return integer
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * @param integer $grade
     * @return Eleve
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;
        return $this;
    }

    /**
     * @return mdp
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * @param string $mdp
     * @return Eleve
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
        return $this;
    }

    /**
     * @return stat
     */
    public function getStat()
    {
        return $this->stat;
    }

    /**
     * @param statut $stat
     * @return Eleve
     */
    public function setStat($stat)
    {
        $this->stat = $stat;
        return $this;
    }

     /**
     * @return mail
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     * @return Eleve
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
        return $this;
    }

}

