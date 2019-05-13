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
    private $signupdate;

    /**
     * @var string
     */
    private $mailaddress;

    /**
     * @var string
     */
    private $passwd;

    /**
     * @var string
     */
    private $activcode;

    /**
     * @var \DateTimeInterface
     */
    private $lastlogdate;

    /**
     * @var string
     */
    private $userrole;

    /**
     * @var string
     */
    private $picturepath;

    /** ---------------------------------------------------------------------------- */
    /** ---------------------------------------------------------------------------- */
    /** ---------------------------------------------------------------------------- */
    /** ---------------------------------------------------------------------------- */

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
    public function getSignupDate(): \DateTimeInterface
    {
        return $this->signupdate;
    }

    /**
     * @param \DateTimeInterface $signupdate
     * @return User
     */
    public function setSignupDate(\DateTimeInterface $sdate)
    {
        $this->birthday = $sdate;
        return $this;
    }

    /**
     * @return string
     */
    public function getMailAddress()
    {
        return $this->mailaddress;
    }

    /**
     * @param string $lastname
     * @return User
     */
    public function setMailAddress($mailaddress)
    {
        $this->mailaddress = $mailaddress;
        return $this;
    }

    /**
     * return Hash
     * @return string
     */
    public function getPasswdH()
    {
        return $this->passwd;
    }

    /**
     * @param string $lastname
     * @return User
     */
    public function setPasswdH($passwd)
    {
        $this->passwd = $passwd;
        return $this;
    }

    /**
     * @return string
     */
    public function getActivCode()
    {
        return $this->activcode;
    }

    /**
     * @param string $lastname
     * @return User
     */
    public function setActivCode($activcode)
    {
        $this->activcode = $activcode;
        return $this;
    }

    /**
     * @param string $lastlogdate
     * @return User
     */
    public function setLastLogDate($lastlogdate)
    {
        $this->lastlogdate = $lastlogdate;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastLogDate()
    {
        return $this->lastlogdate;
    }

    /**
     * @param string $userrole
     * @return User
     */
    public function setUserRole($userrole)
    {
        $this->userrole = $userrole;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserRole()
    {
        return $this->userrole;
    }

    /**
     * @param string $picturepath
     * @return User
     */
    public function setPicturePath($picturepath)
    {
        $this->picturepath = $picturepath;
        return $this;
    }

    /**
     * @return string
     */
    public function getPicturePath()
    {
        return $this->picturepath;
    }

    /** ---------------------------------------------------------------------------- */
    /** ---------------------------------------------------------------------------- */
    /** ---------------------------------------------------------------------------- */
    /** ---------------------------------------------------------------------------- */

    /**
     * @todo Check if working
     * @return int
     * @throws \OutOfRangeException
     */
    public function getAccountAge(): int
    {
        $now = new \DateTime();

        if ($now < $this->getSignupDate()) {
            throw new \OutOfRangeException('Signup date in the future');
        }

        return $now->diff($this->getSignupDate())->y;
    }

    /**
     * @return int
     * @param string $log
     * @param string $pw 
     */
    public function testLogin($log, $pw): int
    {
        $res = 0;
        if ($this->getMailAddress() == $log && $this->getPasswd() == $pw) {
            $res = 1;
        }
        return $res;
    }

}

