<?php

require_once("City.class.php");

class CityManager
{

    private $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }
    
    public function getCityAutocompl($name, $number)
    {
		$statement = $this->connection->prepare("SELECT name FROM cities WHERE name ILIKE :name ORDER BY population DESC FETCH FIRST :number ROWS ONLY");
		$statement->execute(array("name" => $name.'%',"number" => $number));
		$res = $statement->fetchAll();
		
		if (!$res) return [];

        $cities = [];

        foreach($res as $row)
        {
            $cities[] = $row['name'];
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
		$statement = $this->connection->prepare("INSERT INTO cities (name,latitude,longitude,population) VALUES (:name,:latitude,:longitude,:population)");
		return $statement->execute(array("name" => $city->getName, "latitude" => $city->getLatitude, "longitude" => $city->getLongitude, "population" => $city->getPopulation));
	}

	/**
	 * suprime city dans la BD
	 * @access public
	 * @param City $city la ville à suprimer
	 * @return int le nombre de ligne détruite ou false
	 */
    public function delete(City $city) 
    {
		$statement = $this->connection->prepare("DELETE from cities where id = :id");
		return $statement->execute(array("id" => $city->getId()));
    }

	/**
	 * renvoie la city correspondant à l'id ou false s'il n'y en à pas qui correspond
	 * @access public
	 * @param int $id L'id de la ville à aller chercher
	 * @return City ou false
	 */
    public function get($id) 
    {
		$statement = $this->connection->prepare("SELECT * from cities where id = :id");
		$statement->execute(array("id" => $city->getId()));
		$req=$statement->fetch();
		if(!$req)
			return false;
		$admin=new City();
		$admin->hydrate2($req);
		return $admin;
	}
	
	/**
	 * modifie la BD avec les nouvelles valeurs de city
	 * @access public
	 * @param City $city nouvelles valeur à mettre dans la BD
	 * @return void
	 */
    public function update(City $city)
    {
		$statement = $this->connection->prepare("UPDATE from cities set name=:name, latitude=:latitude, longitude=:longitude, population=:population where id=:id");
		return $statement->execute(array("name" => $city->getName(),"latitude"=>$city->getLatitude(),"longitude"=>$city->getLongitude(),"population"=>$city->getPopulation(),"id" => $city->getId()));
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
	
	public function getList()
	{
		$req=$this->connection->query("SELECT * from cities")->fetchAll();
		if($req===false)
			return false;
		return array_map(function ($v) 
		{
			$city=new City();
			$city->hydrate2($v);
			return $city;
		},$req);
	}

}
