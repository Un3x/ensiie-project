<?php
/**
 * Classe représentant un client
 * @see User
 */
require_once('User.class.php');

class Client extends User 
{

	/**
	 * Le nombre de courses acheté
	 * @var unsigned int
	 * @access protected
	 */
	protected  $nbClientCourses;

	/**
	 * retourne nbClientCourses
	 * @access public
	 * @return unsigned int
	 */
	public final  function getNbClientCourses() 
	{
		return $this->nbClientCourses;
	}


	/**
	 * assigne l'argument nbClientCourses si c'est un unsigned int
	 * @access public
	 * @param unsigned int $nbClientCourses le nouveau nbClientCourses
	 * @return void
	 */
	public final  function setNbClientCourses($nbClientCourses) 
	{
		if(!is_int($nbClientCourses)||$nbClientCourses<0)
		{
			trigger_error('nbClientCourses is not an int', E_USER_WARNING);
			return;
		}
		$this->nbClientCourses=$nbClientCourses;
	}

	public  function hydrate($surname,$firstname,Race $race,$mailAddress,$password,$money,$phoneNumber,$birthDate,$reputation,$description,$gender,$nbClientCourses)
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
		$this->setNbClientCourses($nbClientCourses);
		$this->creationDate=date('Y-m-d H:i:s');
	}

	public function hydrate2($sqlRow,Race $race)
	{
		$this->id=$sqlRow['id'];
		$this->hydrate($sqlRow['surname'],$sqlRow['firstname'],$race,$sqlRow['mailaddress'],$sqlRow['password'],$sqlRow['money'],$sqlRow['phonenumber'],date_create($sqlRow['birthdate']),$sqlRow['reputation'],$sqlRow['description'],$sqlRow['gender'],$sqlRow['nbclientcourses']);
		$this->creationDate=date_create($sqlRow['creationdate']);
	}
}
