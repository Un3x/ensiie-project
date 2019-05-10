<?php

require_once('../src/Model/Race/Race.class.php');

/**
 * Classe représentant le compte d'un utilisateur
 */
abstract class User 
{

	/**
	 * id de l'utilisateur 
     * clé primaire dans la BD
	 * @var int
	 * @access protected
	 */
	protected  $id;

	/**
	 * nom de l'utilisateur
	 * @var string
	 * @access protected
	 */
	protected  $surname;

	/**
	 * prenom de l'utilisateur
	 * @var string
	 * @access protected
	 */
	protected  $firstname;

	/**
	 * race de l'utilisateur
	 * @var Race
	 * @access protected
	 */
	protected  $race;

	/**
	 * adresse mail de l'utilisateur
	 * @var string
	 * @access protected
	 */
	protected  $mailAddress;

	/**
	 * mot de passe du compte de l'utilisateur
	 * @var string
	 * @access protected
	 */
	protected  $password;

	/**
	 * argent disponible sur le compte de l'utilisateur
	 * @var double
	 * @access protected
	 */
	protected  $money;

	/**
	 * le numéro de téléphone de l'utilisateur
	 * @var string
	 * @access protected
	 */
	protected  $phoneNumber;

	/**
	 * age de l'utilisateur
	 * @var DateTime
	 * @access protected
	 */
	protected  $birthDate;

	/**
	 * note de 0 à 42 de l'utilisateur
	 * @var int
	 * @access protected
	 */
	protected  $reputation;

	/**
	 * date de création du compte de l'utilisateur
	 * @var DateTime
	 * @access protected
	 */
	protected  $creationDate;

	/**
	 * description de l'utilisateur
	 * @var string
	 * @access protected
	 */
	protected  $description;

	/**
	 * genre de l'utilisateur 
	 * @var enum{apacheHelicopter,other}
	 * @access protected
	 */
	protected  $gender;

	/**
	 * retourne id
	 * @access public
	 * @return int
	 */
	public final  function getId() 
	{
		return $this->id;
	}


	/**
	 * renvoie surname
	 * @access public
	 * @return string
	 */
	public final  function getSurname() 
	{
		return $this->surname;
	}


	/**
	 * renvoie firstName
	 * @access public
	 * @return string
	 */
	public final  function getFirstname() 
	{
		return $this->firstname;
	}


	/**
	 * renvoie race
	 * @access public
	 * @return Race
	 */
	public final  function getRace() 
	{
		return $this->race;
	}


	/**
	 * renvoie mailAddress
	 * @access public
	 * @return string
	 */
	public final  function getMailAddress() 
	{
		return $this->mailAddress;
	}


	/**
	 * renvoie password
	 * @access public
	 * @return string
	 */
	public final  function getPassword() 
	{
		return $this->password;
	}


	/**
	 * renvoie money
	 * @access public
	 * @return double
	 */
	public final  function getMoney() 
	{
		return $this->money;
	}


	/**
	 * renvoie phoneNumbeer
	 * @access public
	 * @return string
	 */
	public final  function getPhoneNumber() 
	{
		return $this->phoneNumber;
	}


	/**
	 * renvoie birthDate
	 * @access public
	 * @return DateTime
	 */
	public final  function getBirthDate() 
	{
		return $this->birthDate;
	}


	/**
	 * renvoie reputation
	 * @access public
	 * @return int
	 */
	public final  function getReputation() 
	{
		return $this->reputation;
	}


	/**
	 * renvoie creationDate
	 * @access public
	 * @return DateTime
	 */
	public final  function getCreationDate() 
	{
		return $this->creationDate;
	}


	/**
	 * renvoie description
	 * @access public
	 * @return string
	 */
	public final  function getDescription() 
	{
		return $this->description;
	}


	/**
	 * renvoie gender
	 * @access public
	 * @return enum{apacheHelicopter,other}
	 */
	public final  function getGender() 
	{
		return $this->gender;
	}

	/**
	 * assigne l'argument à surname si la valeur est valide
	 * @access public
	 * @param string $surname nouveau nom de famille
	 * @return void
	 */
	public final  function setSurname($surname) 
	{
		if(!is_string($surname))
		{
			trigger_error('surname is not a string', E_USER_WARNING);
			return;
		}
		$this->surname=$surname;
	}



	/**
	 * assigne l'argument à firstname si la valeur est valide
	 * @access public
	 * @param string $firstname nouveau prénom
	 * @return void
	 */
	public final  function setFirstname($firstname) 
	{
		if(!is_string($firstname))
		{
			trigger_error('firstname is not a string', E_USER_WARNING);
			return;
		}
		$this->firstname=$firstname;
	}


	/**
	 * assigne l'argument à race si la valeur est valide
	 * @access public
	 * @param Race $race nouvelle race
	 * @return void
	 */
	public final  function setRace(Race $race) 
	{
		$this->race=$race;
	}


	/**
	 * assigne l'argument à mailAddress si la valeur est valide
	 * @access public
	 * @param string $mailAddress nouvelle adresse mail
	 * @return void
	 */
	public final  function setMailAddress($mailAddress) 
	{
		if(!is_string($mailAddress))
		{
			trigger_error('mailAddress is not a string', E_USER_WARNING);
			return;
		}
		$this->mailAddress=$mailAddress;
	}


	/**
	 * assigne l'argument à password si la valeur est valide
	 * @access public
	 * @param string $password nouveau mot de passe
	 * @return void
	 */
	public final  function setPassword($password) 
	{
		if(!is_string($password))
		{
			trigger_error('password is not a string', E_USER_WARNING);
			return;
		}
		$this->password=$password;
	}


	/**
	 * assigne l'argument à money si la valeur est valide
	 * @access public
	 * @param double $money nouveau solde du compte
	 * @return void
	 */
	public final  function setMoney($money)
	{
		if(!is_int($money)&&$money>=0)
		{
			trigger_error('money is not an unsigned int', E_USER_WARNING);
			return;
		}
		$this->money=$money;
	}


	/**
	 * assigne l'argument à phoneNumber si la valeur est valide
	 * @access public
	 * @param string $phoneNumber nouveau numéro de téléphone
	 * @return void
	 */
	public final  function setPhoneNumber($phoneNumber) 
	{
		if(!is_string($phoneNumber))
		{
			trigger_error('phoneNumber is not a string', E_USER_WARNING);
			return;
		}
		$this->phoneNumber=$phoneNumber;
	}


	/**
	 * assigne l'argument à birthDate si la valeur est valide
	 * @access public
	 * @param DateTime $birthDate nouvelle date de naissance
	 * @return void
	 */
	public final  function setBirthDate(DateTime $birthDate)
	{
		$this->birthDate=$birthDate;
	}


	/**
	 * assigne l'argument à reputation si la valeur est valide
	 * @access public
	 * @param int $reputaion nouvelle réputation
	 * @return void
	 */
	public final  function setReputation($reputation) 
	{
		if(!is_int($reputation))
		{
			trigger_error('reputation is not an int', E_USER_WARNING);
			return;
		}
		$this->reputation=$reputation;
	}

	/**
	 * assigne l'argument à description si la valeur est valide
	 * @access public
	 * @param string $description nouvelle description du compte
	 * @return void
	 */
	public final  function setDescription($description) 
	{
		if(!is_string($description))
		{
			trigger_error('description is not a string', E_USER_WARNING);
			return;
		}
		$this->description=$description;
	}


	/**
	 * assigne l'argument à gender si la valeur est valide
	 * @access public
	 * @param string égal à helicopter hapache ou autre $gender nouveau genre de l'utilisateur
	 * @return void
	 */
	public final  function setGender($gender) 
	{
		if(!is_string($gender))
		{
			trigger_error('description is not a string', E_USER_WARNING);
			return;
		}
		if($gender=='hélicopter apache')
			$this->gender=$gender;
		else
			$this->gender='other';
	}

	public  function hydrate($surname,$firstname,Race $race,$mailAddress,$password,$money,$phoneNumber,$birthDate,$reputation,$description,$gender)
	{
		$this->setSurname($surname);
		$this->setFirstname($firstname);
		$this->setRace($race);
		$this->setMailAddress($mailAddress);
		$this->setPassword($password);
		$this->setMoney($money);
		$this->setPhoneNumber($phoneNumber);
		$this->setBirthDate($birthDate);
		$this->setReputation($reputation);
		$this->setDescription($description);
		$this->setGender($gender);
		$this->creationDate=now();
	}

	public function hydrate2($sqlRow,Race $race)
	{
		$this->id=$sqlRow['id'];
		$this->hydrate($sqlRow['surname'],$sqlRow['firstname'],$sqlRow['race'],$sqlRow['mailAddress'],$sqlRow['password'],$sqlRow['money'],$sqlRow['phoneNumber'],$sqlRow['birthDate'],$sqlRow['reputation'],$sqlRow['description'],$sqlRow['gender']);
		$this->creationDate=$sqlRow['creationDate'];
	}
}
