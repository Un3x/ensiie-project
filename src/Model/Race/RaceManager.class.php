<?php

require_once('Race.class.php');

/**
 * La classe gérant Race
 */
class RaceManager 
{

	/**
	 * connection à la BD
	 * @var \PDO
	 * @access protected
	 */
	protected  $connection;


	/**
	 * constructeur
	 * @access public
	 * @param \PDO $connection la connection à la BD
	 */
	public  function __construct(\PDO $connection) 
	{
		$this->connection=$connection;
	}


	/**
	 * ajoute race dans la BD
	 * @access public
	 * @param Race $race l'utilisateur à ajouter à la BD
	 * @return int le nombre de ligne créé ou false
	 */
    public function add(Race $race)
    {
			$statement = $this->connection->prepare("INSERT INTO Race (name,speed,capacity) VALUES (:name,:speed,:capacity)");
			return $statement->execute(array("name" => $race->getName(),"speed"=>$race->getSpeed(),"capacity"=>$race->getCapacity()));		
	}

	/**
	 * suprime race dans la BD
	 * @access public
	 * @param Race $race l'utilisateur à suprimer
	 * @return int le nombre de ligne détruite ou false
	 */
    public function delete(Race $race) 
    {
			$statement = $this->connection->prepare("DELETE from Race where id = :id");
			return $statement->execute(array("id" => $race->getId()));
    }

	/**
	 * renvoie la race correspondant à l'id ou false s'il n'y en à pas qui correspond
	 * @access public
	 * @param int $id L'id de la race à aller chercher
	 * @return Race ou false
	 */
    public function get($id) 
    {
			$statement = $this->connection->prepare("SELECT * from Race where id = :id");
			$statement->execute(array("id" => $id));
			$req=$statement->fetch();
		if($req==false)
			return false;
		$admin=new Race();
		$admin->hydrate2($req);
		return $admin;
	}

	/**
	 * renvoie un booléen correspondant à la présence de $name dans la BD
	 * @access public
	 * @param string le nom
	 * @return true si le nom est dans la BD false sinon
	 */
	public function exist($name)
	{
		return !($this->connection->query("select * from Race where $name=name")->fetch()===false);
	}
	
	/**
	 * modifie la BD avec les nouvelles valeurs de race
	 * @access public
	 * @param Race $race nouvelles valeur à mettre dans la BD
	 * @return void
	 */
    public function update(Race $race)
    {
			$statement = $this->connection->prepare("UPDATE from Race set name=:name, speed=:speed, capacity=:capacity where id=:id");
			return $statement->execute(array("name" => $race->getName(),"latitude"=>$race->getSpeed(),"capacity"=>$race->getCapacity(),"id" => $race->getId()));
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
		$req= $this->connection->query("SELECT * from Race")->fetchAll();
		if($req===false)
			return false;
		return array_map(function ($v) 
		{
			$race=new Race();
			$race->hydrate2($v);
			return $race;
		},$req);
	}

}
