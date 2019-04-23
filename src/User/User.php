<?php
namespace User;

class User
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
    private $pseudo;

    /**
     * @var string
     */
    private $ddn;

    /**
     * @var string
     */
    private $mdp;

    /**
     * @var string
     */
    private $mail;


    /**
     * @var int
     */
    private $nb_livres_empruntes;

    /**
     * @var int
     */
    private $nb_livres_rendus;

    /**
     * @var bool
     */
    private $est_admin;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
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
     * @return string
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
    public function getDdn()
    {
        return $this->ddn;
    }

    /**
     * @param string $ddn
     * @return User
     */
    public function setDdn($ddn)
    {
        $this->ddn = $ddn;
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


    /**
     * @return int
     */
    public function getNbLivresEmpruntes()
    {
        return $this->nb_livres_empruntes;
    }

    /**
     * @param int $nb_livres_empruntes
     * @return User
     */
    public function setNbLivresEmpruntes($nb_livres_empruntes)
    {
        $this->nb_livres_empruntes = $nb_livres_empruntes;
        return $this;
    }

    /**
     * @return int
     */
    public function getNbLivresRendus()
    {
        return $this->nb_livres_rendus;
    }

    /**
     * @param int $nb_livres_rendus
     * @return User
     */
    public function setNbLivresRendus($nb_livres_rendus)
    {
        $this->nb_livres_rendus = $nb_livres_rendus;
        return $this;
    }

    /**
     * @return bool
     */
    public function getAdmin()
    {
        return $this->est_admin;
    }

    /**
     * @param bool $admin
     * @return User
     */
    public function setAdmin($admin)
    {
        $this->est_admin = $admin;
        return $this;
    }


    /**
     * @return int
     * @throws \OutOfRangeException
     */
    public function getAge(): int
    {
        $now = new \DateTime();

        if ($now < $this->getBirthday()) {
            throw new \OutOfRangeException('Birthday in the future');
        }

        return $now->diff($this->getBirthday())->y;
    }
}

