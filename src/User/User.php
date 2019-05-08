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
    private $location;

    /** 
     * @var string
     */
    private $mail;

    /**
     * @var string
     */
    private $mdp;

    /**
     * @var array
     */
    private $photo_id;

    /**
     * @var int
     */
    private $administrateur;

    private $valid;

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

    /**
     * @param $location
     * @return User
     */
    public function setLocation($location){
        $this->location=$location;
        return $this;
    }

    /**
     * @return string
     * @throws \NoStringException
     */
    public function getLocation(): string 
    {
        return $this->$location;
    }

    /** 
     * @param $mail
     * @return User
     */
    public function setMail($mail){
        $this->$mail=$mail;
        return $this;
    }

    /**
     * @return string
     * @throws \NoStringExeception
     */
    public function getMail(): string{
        return $this->$mail;
    }
    
    /**
     * @param string
     * @return User
     */
    public function setMdp($psw){
        $this->$mdp=$psw;
        return $this;
    }

    /**
     * @return string
     * @throws \NoStringException
     */
    public function getMdp(): string{
        return $this->$mdp;
    }

    /**
     * @param int
     * @return User
     */
    public function setAdministrateur($ad) {
        $this->administrateur = $ad;
        return $this;
    }

    /**
     * @return int
     */
    public function getAdministrateur() {
        return $this->administrateur;
    }

    public function setValid($val){
        if ($val == 1){
            $this->valid=1;
        }
        return $this;
    }

    public function getValid(){
        return $this->valid;
    }
}

