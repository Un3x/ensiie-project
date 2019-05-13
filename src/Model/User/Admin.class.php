<?php
/**
 * Classe représentant un administrateur
 * @see User
 */
require_once('User.class.php');

class Admin extends User 
{
	public  function hydrate($surname,$firstname,$mailAddress,$password,$money,$phoneNumber,$birthDate,$reputation,$description,$gender)
	{
		$this->setSurname($surname);
		$this->setFirstname($firstname);
		$this->setMailAddress($mailAddress);
		$this->setPassword($password);
		$this->setMoney($money);
		$this->setPhoneNumber($phoneNumber);
		$this->setBirthDate($birthDate);
		$this->setReputation($reputation);
		$this->setDescription($description);
		$this->setGender($gender);
		$this->creationDate=date_create();
	}

	public function hydrate2($sqlRow)
	{
		$this->id=$sqlRow['id'];
		$this->hydrate($sqlRow['surname'],$sqlRow['firstname'],$sqlRow['mailaddress'],$sqlRow['password'],$sqlRow['money'],$sqlRow['phonenumber'],date_create($sqlRow['birthdate']),$sqlRow['reputation'],$sqlRow['description'],$sqlRow['gender']);
		$this->creationDate=date_create($sqlRow['creationdate']);
	}
}