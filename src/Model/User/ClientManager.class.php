<?php

require_once('Client.class.php');
require_once('UserManager.class.php');

/**
 * La classe gérant Client
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
			$statement = $this->connection->prepare("INSERT INTO Client (surname,firstname,mailAddress,password,money,phoneNumber,birthDate,reputation,creationDate,description,gender,nbClientCourses) VALUES (:surname,:firstname,:mailAddress,:password,:money,:phoneNumber,:birthDate,:reputation,:creationDate,:description,:gender,:nbClientCourses)");

			$a = $statement->execute(array("surname" => $user->getSurname(),"firstname" => $user->getFirstname(),"mailAddress" => $user->getMailAddress(),"password" => password_hash($user->getPassword(), PASSWORD_DEFAULT),"money" => $user->getMoney(),"phoneNumber" => $user->getPhoneNumber(),"birthDate" => $user->getBirthDate()->format('Y-m-d H:i:s'),"reputation" => $user->getReputation(),"creationDate" => $user->getCreationDate()->format('Y-m-d H:i:s'),"description" => $user->getDescription(),"gender" => $user->getGender(),"nbClientCourses" => $user->getNbClientCourses()));
            //print_r($statement->errorInfo());
			return $a;
    }

	/**
	 * suprime user dans la BD
	 * @access public
	 * @param Client $user l'utilisateur à suprimer
	 * @return int le nombre de ligne détruite ou false
	 */
    public function delete($user) 
    {
			$statement = $this->connection->prepare("DELETE from Client where id = :id");
			return $statement->execute(array("id" => $user->getId()));
    }

	/**
	 * renvoie l'utilisateur correspondant à l'id ou false s'il n'y en à pas qui correspond
	 * @access public
	 * @param int $id L'id de l'utilisateur à aller chercher
	 * @return Client ou false
	 */
    public function get($id) 
    {
		$statement = $this->connection->prepare("SELECT * from Client where id = :id");
		$statement->execute(array("id" => $id));
		$req=$statement->fetch();
		if($req==false)
			return false;
		$admin=new Client();
		$admin->hydrate2($req);
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
		$statement = $this->connection->prepare("SELECT id, password from Client where mailAddress = :mailAddress");
		$statement->execute(array("mailAddress" => $mailAddress));
		$req=$statement->fetch();

		return !password_verify($password, $req['password'])?false:$this->get($req['id']);
	}
	
	/**
	 * modifie la BD avec les nouvelles valeurs de user
	 * @access public
	 * @param Client $user nouvelles valeur à mettre dans la BD
	 * @return void
	 */
    public function update($user)
    {
			$statement = $this->connection->prepare("UPDATE Client set surname=:surname, firstname=:firstname, mailAddress=:mailAddress, passWord=:passWord, money=:money, phoneNumber=:phoneNumber, birthDate=:birthDate, reputation=:reputation, creationDate=:creationDate, description=:description, gender=:gender, nbClientCourses=:nbClientCourses where id=:id");
			$a = $statement->execute(array("surname" => $user->getSurname(),"firstname" => $user->getFirstname(),"mailAddress" => $user->getMailAddress(),"passWord" => password_hash($user->getPassword(), PASSWORD_DEFAULT),"money" => $user->getMoney(),"phoneNumber" => $user->getPhoneNumber(),"birthDate" => $user->getBirthDate()->format('Y-m-d H:i:s'),"reputation" => $user->getReputation(),"creationDate" => $user->getCreationDate()->format('Y-m-d H:i:s'),"description" => $user->getDescription(),"gender" => $user->getGender(),"nbClientCourses" => $user->getNbClientCourses(),"id" => $user->getId()));
            print_r($statement->errorInfo());
            return $statement;

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
			$client->hydrate2($v);
			return $client;
		},$req);
	}
}
