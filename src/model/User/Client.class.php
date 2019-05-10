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
		parent::hydrate($surname,$firstname,$race,$mailAddress,$password,$money,$phoneNumber,$birthDate,$reputation,$description,$gender);
		$this->setNbClientCourses($nbClientCourses);
	}

	public function hydrate2($sqlRow,Race $race)
	{
		$this->id=$sqlRow['id'];
		$this->hydrate($sqlRow['surname'],$sqlRow['firstname'],$sqlRow['race'],$sqlRow['mailAddress'],$sqlRow['password'],$sqlRow['money'],$sqlRow['phoneNumber'],$sqlRow['birthDate'],$sqlRow['reputation'],$sqlRow['description'],$sqlRow['gender'],$sqlRow['nbClientCourses']);
		$this->creationDate=$sqlRow['creationDate'];
	}
}
