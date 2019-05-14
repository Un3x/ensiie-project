<?php

require_once('Admin.class.php');
require_once('UserManager.class.php');

/**
 * La classe gérant Admin
 */
class AdminManager extends UserManager
{

	public  function __construct(\PDO $connection) 
	{
		parent::__construct($connection);
	}

	/**
	 * ajoute user dans la BD
	 * @access public
	 * @param Admin $user l'utilisateur à ajouter à la BD
	 * @return int le nombre de ligne créé ou false
	 */
    public function add($user)
    {
		$statement = $this->connection->prepare("INSERT INTO Admin (surname,firstname,mailAddress,password,money,phoneNumber,birthDate,reputation,creationDate,description,gender) VALUES (:surname,:firstname, :mailAddress,:password,:money,:phoneNumber,:birthDate,:reputation,:creationDate,:description,:gender)");
		$a = $statement->execute(array("surname" => $user->getSurname(),"firstname" => $user->getFirstname(),"mailAddress" => $user->getMailAddress(),"password" => $user->getPassword(),"money" => $user->getMoney(),"phoneNumber" => $user->getPhoneNumber(),"birthDate" => $user->getBirthDate()->format('Y-m-d H:i:s'),"reputation" => $user->getReputation(),"creationDate" => $user->getCreationDate()->format('Y-m-d H:i:s'),"description" => $user->getDescription(),"gender" => $user->getGender()));
	    print_r($statement->errorInfo());
        return $a;
    }

	/**
	 * suprime user dans la BD
	 * @access public
	 * @param Admin $user l'utilisateur à suprimer
	 * @return int le nombre de ligne détruite ou false
	 */
    public function delete($user) 
    {
		$statement = $this->connection->prepare("DELETE from Admin where id = :id");
		return $statement->execute(array("id" => $user->getId()));
    }

	/**
	 * renvoie l'utilisateur correspondant à l'id ou false s'il n'y en à pas qui correspond
	 * @access public
	 * @param int $id L'id de l'utilisateur à aller chercher
	 * @return Admin ou false
	 */
    public function get($id) 
    {
        $statement = $this->connection->prepare("SELECT * from Admin where id = :id");
		$statement->execute(array("id" => $id));
		$req=$statement->fetch();	
		if($req==false)
			return false;
		$admin=new Admin();
		$admin->hydrate2($req);
		return $admin;
	}
	
	/**
	 * renvoie l'utilisateur correspondant au mail et mdp ou false s'il n'y en à pas qui correspond
	 * @access public
	 * @param string l'adresse mail
	 * @param string le mot de passe
	 * @return User ou false
	 */
    public function get2($mailAddress, $password) 
    {
        $statement = $this->connection->prepare("SELECT id from Admin where mailAddress = :mailAddress and password = :password");
		$statement->execute(array("mailAddress" => $mailAddress,"password" => $password));
		$req=$statement->fetch();
		return $req===false?false:($this->get($req['id']));
	}

	/**
	 * modifie la BD avec les nouvelles valeurs de user
	 * @access public
	 * @param Admin $user nouvelles valeur à mettre dans la BD
	 * @return void
	 */
    public function update($user)
    {
		$statement = $this->connection->prepare("UPDATE  Admin set surname=:surname, firstname=:firstname,mailAddress=:mailAddress, passWord=:passWord, money=:money, phoneNumber=:phoneNumber, birthDate=:birthDate, reputation=:reputation, creationDate=:creationDate, description=:description, gender=:gender where id=:id");
		 return $statement->execute(array("surname" => $user->getSurname(),"firstname" => $user->getFirstname(),"mailAddress" => $user->getMailAddress(),"passWord" => $user->getPassword(),"money" => $user->getMoney(),"phoneNumber" => $user->getPhoneNumber(),"birthDate" => $user->getBirthDate(),"reputation" => $user->getReputation(),"creationDate" => $user->getCreationDate(),"description" => $user->getDescription(),"gender" => $user->getGender(),"id" => $user->getId()));

    }

	/**
	 * renvoie la liste de tout les utilisateurs
	 * @access public
	 * @return liste des admin
	 */
	public function getList()
	{
		$req=$this->connection->query("SELECT * from Admin")->fetchAll();
		if($req===false)
			return false;
		return array_map(function ($v) 
		{
			$admin=new Admin();
			$admin->hydrate2($v);
			return $admin;
		},$req);
	}
}
