<?php

require_once('Vendor.class.php');
require_once('ClientManager.class.php');

/**
 * La classe gérant Admin
 */
class VendorManager extends ClientManager
{
	public  function __construct(\PDO $connection) 
	{
		parent::__construct($connection);
	}

	/**
	 * ajoute user dans la BD
	 * @access public
	 * @param Vendor $user l'utilisateur à ajouter à la BD
	 * @return int le nombre de ligne créé ou false
	 */
    public function add($user)
    {
		return $this->connection->exec("INSERT INTO Vendor (surname,firstname,idRace,mailAddress,password,money,phoneNumber,birthDate,reputation,creationDate,description,gender,nbClientCourses,nbVendorCourses,occupied,position) VALUES ($user->getSurname(),$user->getFirstname(),$user->getRace()->getId(),$user->getMailAddress(),$user->getPassword(),$user->getMoney(),$user->getPhoneNumber(),$user->getBirthDate(),$user->getReputation(),$user->getCreationDate(),$user->getDescription(),$user->getGender(),$user->getNbClientCourses(),$user->getNbVendorCourses(),$user->getOccupied(),$user->getPosition())");
	}

	/**
	 * suprime user dans la BD
	 * @access public
	 * @param Vendor $user l'utilisateur à suprimer
	 * @return int le nombre de ligne détruite ou false
	 */
    public function delete($user) 
    {
			return $this->connection->exec("DELETE from Vendor where $user->getId()=id");
    }

	/**
	 * renvoie l'utilisateur correspondant à l'id ou false s'il n'y en à pas qui correspond
	 * @access public
	 * @param int $id L'id de l'utilisateur à aller chercher
	 * @return Vendor ou false
	 */
    public function get($id) 
    {
		$req=$this->connection->query("SELECT * from Vendor where id=$id")->fetch();
		if($req==false)
			return false;
		$admin=new Vendor();
		$raceManager=new RaceManager($this->connection);
		$admin->hydrate2($req,$raceManager->get($req['idrace']));
		return $admin;
	}
	
	/**
	 * renvoie l'utilisateur correspondant au mail et mdp ou false s'il n'y en à pas qui correspond
	 * @access public
	 * @param string l'adresse mail
	 * @param string le mot de passe
	 * @return Vendor ou false
	 */
  public function get2($mailAddress, $password) 
  {
		$req=$this->connection->query("select id from Vendor where mailAddress='$mailAddress' and password='$password'")->fetch();
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
		return $this->connection->query("select * from Vendor where mailAddress='$mailAddress'")->fetch()!==false;
	}
	
	/**
	 * modifie la BD avec les nouvelles valeurs de user
	 * @access public
	 * @param Vendor $user nouvelles valeur à mettre dans la BD
	 * @return void
	 */
    public function update($user)
    {
			return $this->connection->exec("update from Vendor surname='$user->getSurname()',firstname='$user->getFirstname()',idRace='$user->getRace()->getId()',mailAddress='$user->getMailAddress()',passWord='$user->getPassword()',money='$user->getMoney()',phoneNumber='$user->getPhoneNumber()',birthDate='$user->getBirthDate()',reputation='$user->getReputation()',creationDate='$user->getCreationDate()',description='$user->getDescription()',gender='$user->getGender()', nbClientCourses='$user->getNbClientCourses()',$user->getNbClientCourses(),nbVendorCourses='$user->getNbVendorCourses()',occupied='$user->getOccupied()',position='$user->getPosition()' where $user->getId()=id");
    }

	/**
	 * renvoie la liste de tout les utilisateurs
	 * @access public
	 * @return tout les vendeurs
	 */
	public function getList()
	{
		$req=$this->connection->query("SELECT * from Vendor")->fetchAll();
		if($req===false)
			return false;
		return array_map(function ($v) 
		{
			$vendor=new Vendor();
			$raceManager=new RaceManager($this->connection);
			$vendor->hydrate2($v,$raceManager->get($v['idrace']));
			return $vendor;
		},$req);
	}
}
