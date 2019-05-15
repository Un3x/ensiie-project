<?php
namespace Admin;

class Admin
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $prenom;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $email;
    
    /**
     * @var string
     */
    private $mdp;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Admin
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @return Admin
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
     
     * @return Admin
     */
    public function setNom($nom)
    {
        $this->prenom = $nom;
        return $this;
    }


    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Admin
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
     * @param string $mdp
     * @return Admin
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
        return $this;
    } 
} 
