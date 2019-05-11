<?php
/**
 * Classe représentant un administrateur
 * @see User
 */
require_once('User.class.php');

class Admin extends User 
{
	public  function hydrate($surname,$firstname,Race $race,$mailAddress,$password,$money,$phoneNumber,$birthDate,$reputation,$description,$gender)
	{
		$this->setSurname($surname);
		$this->setFirstname($firstname);
		$this->setRace($race);
		$this->setMailAddress($mailAddress);
		$this->setPassword($password);
		$this->setMoney($money);
		$this->setPhoneNumber($phoneNumber);
		$this->setBirthDate($birthDate);
		$this->setReputation($reputation);
		$this->setDescription($description);
		$this->setGender($gender);
		$this->creationDate=date('Y-m-d H:i:s');
	}

	public function hydrate2($sqlRow,Race $race)
	{
		$this->id=$sqlRow['id'];
		$this->hydrate($sqlRow['surname'],$sqlRow['firstname'],$race,$sqlRow['mailaddress'],$sqlRow['password'],$sqlRow['money'],$sqlRow['phonenumber'],date_create($sqlRow['birthdate']),$sqlRow['reputation'],$sqlRow['description'],$sqlRow['gender']);
		$this->creationDate=date_create($sqlRow['creationdate']);
	}
}