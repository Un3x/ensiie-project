<?php

require_once('Client.class.php');
require_once('UserManager.class.php');

/**
 * La classe gérant Admin
 */
class ClientManager extends UserManager
{
	public  function __construct(\PDO $connection) 
	{
		parent::__construct($connection);
	}
	/**
	 * ajoute user dans la BD
	 * @access public
	 * @param Client $user l'utilisateur à ajouter à la BD
	 * @return int le nombre de ligne créé ou false
	 */
    public function add($user)
    {
        //echo("INSERT INTO Client (surname,firstname,idRace,mailAddress,password,money,phoneNumber,birthDate,reputation,creationDate,description,gender,nbClientCourses) VALUES (    '".$user->getSurname()."' , '".$user->getFirstname()."', ".$user->getRace()->getId().", '".$user->getMailAddress()."','".$user->getPassword()."' ,   ".$user->getMoney().", ".$user->getPhoneNumber().", '".$user->getBirthDate()->format("Y-m-d")."',".$user->getReputation().",'".$user->getCreationDate()  ."','".$user->getDescription()."','".$user->getGender()."',".$user->getNbClientCourses(). ") ");
		return $this->connection->exec("INSERT INTO Client (surname,firstname,idRace,mailAddress,password,money,phoneNumber,birthDate,reputation,creationDate,description,gender,nbClientCourses) VALUES (    '".$user->getSurname()."' , '".$user->getFirstname()."', ".$user->getRace()->getId().", '".$user->getMailAddress()."','".$user->getPassword()."' ,   ".$user->getMoney().", ".$user->getPhoneNumber().", '".$user->getBirthDate()->format("Y-m-d")."',".$user->getReputation().",'".$user->getCreationDate()  ."','".$user->getDescription()."','".$user->getGender()."',".$user->getNbClientCourses(). ") ");
	}

	/**
	 * suprime user dans la BD
	 * @access public
	 * @param Client $user l'utilisateur à suprimer
	 * @return int le nombre de ligne détruite ou false
	 */
    public function delete($user) 
    {
			return $this->connection->exec("DELETE from Client where $user->getId()=id");
    }

	/**
	 * renvoie l'utilisateur correspondant à l'id ou false s'il n'y en à pas qui correspond
	 * @access public
	 * @param int $id L'id de l'utilisateur à aller chercher
	 * @return Client ou false
	 */
    public function get($id) 
    {
		$req=$this->connection->query("SELECT * from Client where id=$id")->fetch();
		if($req==false)
			return false;
		$admin=new Client();
		$raceManager=new RaceManager($this->connection);
		$admin->hydrate2($req,$raceManager->get($req['idrace']));
		return $admin;
	}
	
	/**
	 * renvoie l'utilisateur correspondant au mail et mdp ou false s'il n'y en à pas qui correspond
	 * @access public
	 * @param string l'adresse mail
	 * @param string le mot de passe
	 * @return Client ou false
	 */
  public function get2($mailAddress, $password) 
  {
		$req=$this->connection->query("select id from Client where mailAddress='$mailAddress' and password='$password'")->fetch();
		return $req===false?false:($this->get($req['id']));
	}

	/**
	 * renvoie l'utilisateur correspondant au mail et mdp ou false s'il n'y en à pas qui correspond
	 * @access public
	 * @param string l'adresse mail
	 * @return true si l'adresse mail est dans la BD false sinon
	 */
	public function isUsed($mailAddress)
	{
		return (($this->connection)->query("select * from client where mailaddress='$mailAddress'")->fetch())!=false;
	}
	
	/**
	 * modifie la BD avec les nouvelles valeurs de user
	 * @access public
	 * @param Client $user nouvelles valeur à mettre dans la BD
	 * @return void
	 */
    public function update($user)
    {
        //echo ("update Client set surname='".$user->getSurname()."',firstname='".$user->getFirstname()."',idRace='".$user->getRace()->getId()."',mailAddress='".$user->getMailAddress()."',password='".$user->getPassword()."',money='".$user->getMoney()."',phoneNumber='".$user->getPhoneNumber()."',birthDate='".$user->getBirthDate()->format("Y-m-d")."',reputation='".$user->getReputation()."',creationDate='".$user->getCreationDate()->format("Y-m-d")."',description='".$user->getDescription()."',gender='".$user->getGender()."', nbClientCourses='".$user->getNbClientCourses()."' where ".$user->getId()."=id" );
        return $this->connection->exec("update Client set surname='".$user->getSurname()."',firstname='".$user->getFirstname()."',idRace='".$user->getRace()->getId()."',mailAddress='".$user->getMailAddress()."',password='".$user->getPassword()."',money='".$user->getMoney()."',phoneNumber='".$user->getPhoneNumber()."',birthDate='".$user->getBirthDate()->format("Y-m-d")."',reputation='".$user->getReputation()."',creationDate='".$user->getCreationDate()->format("Y-m-d")."',description='".$user->getDescription()."',gender='".$user->getGender()."', nbClientCourses='".$user->getNbClientCourses()."' where ".$user->getId()."=id" );
    }

	/**
	 * renvoie la liste de tout les utilisateurs
	 * @access public
	 * @return liste de client
	 */
	public function getList()
	{
		$req=$this->connection->query("SELECT * from Client")->fetchAll();
		if($req===false)
			return false;
		return array_map(function ($v) 
		{
			$client=new Client();
			$raceManager=new RaceManager($this->connection);
			$client->hydrate2($v,$raceManager->get($v['idrace']));
			return $client;
		},$req);
	}
}
