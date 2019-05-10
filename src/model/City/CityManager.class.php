<?php

require_once("city.class.php");

class CityManager
{

    private $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }
    
    public function getCityAutocompl($name, $number)
    {
        $res = $this->connection->query("SELECT name FROM cities WHERE name ILIKE '$name%' ORDER BY population DESC FETCH FIRST $number ROWS ONLY")->fetchAll(\PDO::FETCH_OBJ);;

        $cities = [];

        foreach($res as $row)
        {
            $cities[] = $row->name;
        }

        return $cities;
    }

    /**
	 * ajoute city dans la BD
	 * @access public
	 * @param City $city la ville à ajouter à la BD
	 * @return int le nombre de ligne créé ou false
	 */
    public function add(City $city)
    {
		return $this->connection->exec("INSERT INTO cities (name,latitude,longitude,population) VALUES ($city->getName,$city->getLatitude,$city->getLongitude,$city->getPopulation)");
	}

	/**
	 * suprime city dans la BD
	 * @access public
	 * @param City $city la ville à suprimer
	 * @return int le nombre de ligne détruite ou false
	 */
    public function delete(City $city) 
    {
			return $this->connection->exec("DELETE from cities where $city->getId()=id");
    }

	/**
	 * renvoie la city correspondant à l'id ou false s'il n'y en à pas qui correspond
	 * @access public
	 * @param int $id L'id de la ville à aller chercher
	 * @return City ou false
	 */
    public function get($id) 
    {
		$req=$this->connection->query("SELECT * from cities where id=$id")->fetch();
		if($req==false)
			return false;
		$admin=new City();
		$admin->hydrate2($req);
	}
	
	/**
	 * modifie la BD avec les nouvelles valeurs de city
	 * @access public
	 * @param City $city nouvelles valeur à mettre dans la BD
	 * @return void
	 */
    public function update(City $city)
    {
			return $this->connection->exec("update from cities set name='$city->getName()',latitude='$city->getLatitude()',longitude='$city->getLongitude()',population='$city->getPopulation()' where $city->getId()=id");
    }
	/**
	 * change la valeur de connection
	 * @access public
	 * @param /PDO $connection nouvelle connection
	 * @return void
	 */
	public final  function setDb(\PDO $connection) 
	{
		$this->connection=$connection;
	}

}
