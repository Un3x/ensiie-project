<?php
namespace User;

class User
{


    /**
     * @var int
     */
    private $iduser;

    /**
     * @var VARCHAR NOT NULL
     */
    /*private $mail;*/

    /**
     * @var string
     */
    private $pseudo;


    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var \DateTimeInterface
     */
    private $birthday;

     /**
     * @var string
     */
    private $mdp;

    /**
     * @return varchar
     */
    /*public function getMail()
    {
        return $this->mail;
    }*/

    /**
     * @param varchar $mail
     * @return User
     */
    /*public function setMail($mail)
    {
        $this->mail = $mail;
        return $this;
    }*/

    /**
     * @return int
     */
    public function getId()
    {
        return $this->iduser;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId($id)
    {
        $this->iduser = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getBirthday(): \DateTimeInterface
    {
        return $this->birthday;
    }

    /**
     * @param \DateTimeInterface $birthday
     * @return User
     */
    public function setBirthday(\DateTimeInterface $birthday)
    {
        $this->birthday = $birthday;
        return $this;
    }

    /*pas encore commenté*/
    
     public function getpseudo()
    {
        return $this->pseudo;
    }


    public function setpseudo($ps)
    {
        $this->pseudo = $ps;
        return $this;
    }

     public function getmdp()
    {
        return $this->mdp;
    }


    public function setmdp($mdp)
    {
        $this->mdp = $mdp;
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

