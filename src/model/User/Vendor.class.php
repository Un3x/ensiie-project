<?php
/**
 * Classe représentant un vendeur
 * @see        Client
 */
require_once('Client.class.php');

class Vendor extends Client 
{

	/**
	 * Le nombre de courses vendu
	 * @var unsigned int
	 * @access protected
	 */
	protected  $nbVendorCourses;

	/**
	 * true si il est occupé false si il est disponible
	 * @var bool
	 * @access protected
	 */
	protected  $occupied;

	/**
	 * id de la ville où il est
	 * @var int
	 * @access protected
	 */
	protected  $position;


	/**
	 * retourne nbVendorCourses
	 * @access public
	 * @return unsigned int
	 */
	public final  function getNbVendorCourses() 
	{
		return $this->nbVendorCourses;
	}


	/**
	 * retourne occupied
	 * @access public
	 * @return bool
	 */
	public final  function getOccupied() 
	{
		return $this->occupied;
	}


	/**
	 * retourne position
	 * @access public
	 * @return int
	 */
	public final  function getPosition() 
	{
		return $this->position;
	}


	/**
	 * assigne l'argument nbVendorCourses si c'est un unsigned int
	 * @access public
	 * @param unsigned int $nbVendorCourses le nouveau nbVendorCourses
	 * @return void
	 */
	public final  function setNbVendorCourses($nbVendorCourses) 
	{
		if(!is_int($nbVendorCourses)||$nbVendorCourses<0)
		{
			trigger_error('nbVendorCourses is not an int', E_USER_WARNING);
			return;
		}
		$this->nbVendorCourses=$nbVendorCourses;
	}


	/**
	 * assigne l'argument à occupied
	 * @access public
	 * @param bool $occupied Le nouveau occupied
	 * @return void
	 */
	public final  function setOccupied($occupied) 
	{
		if(!is_bool($occupied))
		{
			trigger_error('occupied is not a bool', E_USER_WARNING);
			return;
		}
		$this->occupied=$occupied;
	}


	/**
	 * assigne la nouvelle position à position si c'est un entier
	 * @access public
	 * @param int $position La nouvelle position
	 * @return void
	 */
	public final  function setPosition($position) 
	{
		if(!is_int($position))
		{
			trigger_error('position is not an int', E_USER_WARNING);
			return;
		}
		$this->position=$position;
	}

	public  function hydrate($surname,$firstname,Race $race,$mailAddress,$password,$money,$phoneNumber,$birthDate,$reputation,$description,$gender,$nbClientCourses,$nbVendorCourses,$occupied,$position)
	{
		parent::hydrate($surname,$firstname,$race,$mailAddress,$password,$money,$phoneNumber,$birthDate,$reputation,$description,$gender,$nbClientCourses);
		$this->setNbVendorCourses($nbVendorCourses);
		$this->setOccupied($occupied);
		$this->setPosition($position);
	}

	public function hydrate2($sqlRow,Race $race)
	{
		$this->id=$sqlRow['id'];
		$this->hydrate($sqlRow['surname'],$sqlRow['firstname'],$sqlRow['race'],$sqlRow['mailAddress'],$sqlRow['password'],$sqlRow['money'],$sqlRow['phoneNumber'],$sqlRow['birthDate'],$sqlRow['reputation'],$sqlRow['description'],$sqlRow['gender'],$sqlRow['nbClientCourses'],$sqlRow['nbVendorCourses'],$sqlRow['occupied'],$sqlRow['position']);
		$this->creationDate=$sqlRow['creationDate'];
	}
}
