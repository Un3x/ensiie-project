<?php
namespace User;

class User
{
    /**
     * @var string
     */
    private $pseudo;

    /**
     * @var string
     */
    private $mdp;

    /**
     * @var string
     */
    private $prenom;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var char
     */
    private $statut;

    /**
     * @var
     */
    private $mail;

    /**
     * @return 
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param string $pseudo
     * @return User
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
        return $this;
    }

    /**
     * @return string
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * @param string mdp
     * @return User
     */
    public function setMdp($mdp) 
    {
        $this->mdp = $mdp;
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
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
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
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

        /**
     * @return char
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param char $statut
     * @return User
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
        return $this;
    }

        /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     * @return User
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
        return $this;
    }

}
