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
	private $password;
	private $president;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var int
     */
	private $promo;

	/**
	 *  @var string
	 */
	private $pseudo;
	private $bde;

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
	
	public function setPassword($password)
	{
		$this->password = $password;
		return $this;
	}

	public function getPassword()
	{
		return $this->password;	
	}

	public function setPseudo($pseudo)
	{
		$this->pseudo = $pseudo;
		return $this;
	}
	public function getPseudo()
	{
		return $this->pseudo;
	}

    /**
     * @return int
     */
    public function getPromo()
    {
        return $this->promo;
    }

    /**
     * @param int $promo
     * @return User
     */
    public function setPromo($promo)
    {
        $this->promo = $promo;
        return $this;
    }


    /**
     * @return int
     */
    public function getAnnee(): int
    {
		$promo = $this->promo;
		$before = strtotime('09/01/$promo');

		$age = date('Y')-$promo;
		if (date('md') < date('md', $before)) {
			return $age-1;
		}
		return $age;
    }

	public function setBde($bde) {
		$this->bde=$bde;
		return $this;
	}
	public function getBde() {
		return $this->bde;
	}

	public function setPresident($president) {
		$this->president = $president;
		return $this;
	}
	public function getPresident(){
		return $this->president;
	}
}

