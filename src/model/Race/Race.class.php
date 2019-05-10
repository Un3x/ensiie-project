<?php

/**
 * Classe représentant une race
 */
abstract class Race 
{

	/**
	 * id de la race
     * clé primaire dans la BD
	 * @var int
	 * @access protected
	 */
	protected  $id;

	/**
	 * nom de la race
	 * @var string
	 * @access protected
	 */
	protected  $name;

	/**
	 * vitesse de la race
	 * @var double
	 * @access protected
	 */
	protected  $speed;

	/**
	 * nombre de personne transportable par la race
	 * @var int
	 * @access protected
	 */
	protected  $capacity;

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
	 * renvoie name
	 * @access public
	 * @return string
	 */
	public final  function getName() 
	{
		return $this->name;
	}


	/**
	 * renvoie speed
	 * @access public
	 * @return double
	 */
	public final  function getSpeed() 
	{
		return $this->speed;
	}


	/**
	 * renvoie capacity
	 * @access public
	 * @return int
	 */
	public final  function getCapacity() 
	{
		return $this->capacity;
	}

	/**
	 * assigne l'argument à name si la valeur est valide
	 * @access public
	 * @param string $name nouveau nom
	 * @return void
	 */
	public final  function setname($name) 
	{
		if(!is_string($name))
		{
			trigger_error('name is not a string', E_USER_WARNING);
			return;
		}
		$this->name=$name;
	}



	/**
	 * assigne l'argument à speed si la valeur est valide
	 * @access public
	 * @param double $speed nouvelle vitesse
	 * @return void
	 */
	public final  function setSpeed($speed) 
	{
		if(!is_double($speed))
		{
			trigger_error('speed is not a double', E_USER_WARNING);
			return;
		}
		$this->speed=$speed;
	}


	/**
	 * assigne l'argument à capacity si la valeur est valide
	 * @access public
	 * @param int $capacity nouvelle capacité
	 * @return void
	 */
	public final  function setCapacity($capacity) 
	{
		if(!is_int($capacity))
		{
			trigger_error('capacity is not a double', E_USER_WARNING);
			return;
		}
		$this->capacity=$capacity;
	}

	public  function hydrate($name,$speed,$capacity)
	{
		$this->setName($name);
		$this->setSpeed($speed);
		$this->setCapacity($capacity);
	}

	public function hydrate2($sqlRow)
	{
		$this->id=$sqlRow['id'];
		$this->hydrate($sqlRow['name'],$sqlRow['speed'],$sqlRow['capacity']);

	}
}
