<?php

class City 
{
    /**
	 * id de la ville
	 * @var int
	 * @access protected
	 */
    private $id;

    /**
	 * nom de la ville
	 * @var string
	 * @access protected
	 */
    private $name;
    
    /**
	 * latitude de la ville
	 * @var double
	 * @access protected
	 */
    private $latitude;
    
    /**
	 * longitude de la ville
	 * @var double
	 * @access protected
	 */
    private $longitude;
    
    /**
	 * population de la ville
	 * @var unsigned int
	 * @access protected
	 */
    private $population;

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
	 * retourne name
	 * @access public
	 * @return string
	 */
	public final  function getName() 
	{
		return $this->name;
    }
    
    /**
	 * retourne latitude
	 * @access public
	 * @return double
	 */
	public final  function getLatitude() 
	{
		return $this->latitude;
    }
    
    /**
	 * retourne longitude
	 * @access public
	 * @return double
	 */
	public final  function getLongitude() 
	{
		return $this->longitude;
    }
    
    /**
	 * retourne population
	 * @access public
	 * @return unsigned int
	 */
	public final  function getPopulation() 
	{
		return $this->population;
	}

	/**
	 * assigne l'argument name si c'est un string
	 * @access public
	 * @param string $name le nouveau nom
	 * @return void
	 */
	public final  function setName($name) 
	{
		if(!is_string($name))
		{
			trigger_error('name is not a string', E_USER_WARNING);
			return;
		}
		$this->name=$name;
    }
    
    /**
	 * assigne l'argument latitude si c'est un double
	 * @access public
	 * @param double $latitude le nouveau latitude
	 * @return void
	 */
	public final  function setLatitude($latitude) 
	{
		if(!is_numeric($latitude))
		{
			trigger_error('latitude is not an double', E_USER_WARNING);
			return;
		}
		$this->latitude=$latitude;
    }
    
    /**
	 * assigne l'argument longitude si c'est un double
	 * @access public
	 * @param double $longitude la nouvelle longitude
	 * @return void
	 */
	public final  function setLongitude($longitude) 
	{
		if(!is_numeric($longitude))
		{
			trigger_error('longitude is not an double', E_USER_WARNING);
			return;
		}
		$this->longitude=$longitude;
    }
    
    /**
	 * assigne l'argument population si c'est un unsigned int
	 * @access public
	 * @param unsigned int $population le nouveau population
	 * @return void
	 */
	public final  function setPopulation($population) 
	{
		if(!is_int($population)||$population<0)
		{
			trigger_error('population is not an unsigned int', E_USER_WARNING);
			return;
		}
		$this->population=$population;
		}
		
	/**
	 * assigne l'argument id si c'est un unsigned int
	 * @access public
	 * @param unsigned int $id le nouveau id
	 * @return void
	 */
	public final  function setId($id) 
	{
		if(!is_int($id)||$id<0)
		{
			trigger_error('id is not an unsigned int', E_USER_WARNING);
			return;
		}
		$this->id=$id;
    }

	public  function hydrate($name,$latitude,$longitude,$population,$id)
	{
        $this->setName($name);
        $this->setLatitude($latitude);
        $this->setLongitude($longitude);
				$this->setPopulation($population);
				$this->setId($id);
	}

	public function hydrate2($sqlRow)
	{
		$this->hydrate($sqlRow['name'],$sqlRow['latitude'],$sqlRow['longitude'],$sqlRow['population'],$sqlRow['id']);
	}






}
