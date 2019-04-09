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
    private $city;

    /**
     * @var int
     */
    private $yop;

    /**
     * @var string
     */
    private $mail;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $current_training;

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
    public function getBirthday(): ?\DateTimeInterface
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
     * @return string
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * @param string $city
     * @return User
     */
    public function setCity(string $city) {
        $this->city = $city;
        return $this;
    }

    /**
     * @return int
     */
    public function getYop() {
        return $this->yop;
    }

    /**
     * @param int $yop
     * @return User
     */
    public function setYop($yop) {
        $this->yop = $yop;
        return $this;
    }

    /**
     * @return string
     */
    public function getMail() {
        return $this->mail;
    }

    /**
     * @param string $mail
     * @return User
     */
    public function setMail($mail) {
        $this->mail = $mail;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return User
     */
    public function setPhone($phone) {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrent_training() {
        return $this->current_training;
    }

    /**
     * @param string $current_training
     * @return User
     */
    public function setCurrent_training($current_training) {
        $this->current_training = $current_training;
        return $this;
    }
}

