<?php
namespace User;
require_once "User.php";
class UserRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * array of all users
     */
    private $usersArray;

    /**
     * UserRepository constructor.
     * @param \PDO $connection
     * @todo check if connection ok
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
        $this->usersArray = $this->fetchAll();
    }

    /**
     * @todo verifier unicite mail
     */
    private function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "users"')->fetchAll(\PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $user = new User();
            $user
                ->setId($row->id)
                ->setFirstname($row->firstname)
                ->setLastname($row->lastname)
                ->setSignupDate(new \DateTimeImmutable($row->signupdate))
                ->setMailAddress($row->mailaddress)
                ->setPasswdH($row->passwd)
                ->setActivCode($row->activcode)
                ->setLastLogDate($row->lastlogdate)
                ->setUserRole($row->userrole)
                ->setPicturePath($row->picturepath);

            $users[$row->mailaddress] = $user;
        }

        return $users;
    }

    /**
     * pwh = password hash
     * returns user found if ok, false else
     */
    public function logInWithCredentials($log, $pwh)
    {
        if(array_key_exists($log,$this->usersArray)){
            if($this->usersArray[$log]->getPasswdH() == $pwh){
                return $this->usersArray[$log];
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    /**
     * check if email (login) already in database
     */
    public function emailInBase($email)
    {
        if(array_key_exists($email,$this->usersArray)){
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getUserArray()
    {
        return $this->usersArray;
    }

    public function addUser($firstname, $lastname, $mailaddress, $pwh, $activcode, $userrole){
        /**
         * $sql = "INSERT INTO users (name, surname, sex) VALUES (?,?,?)";
         * $pdo->prepare($sql)->execute([$name, $surname, $sex]);
         */
        $signupdate = date('Y-m-d G:i:s');
        $lastlogdate = $signupdate;
        $activcode = 1;
        $insertionUser = 'INSERT INTO "users"(firstname, lastname, signupdate, mailaddress, passwd, activcode, lastlogdate, userrole) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
        $this->connection->prepare($insertionUser)->execute([$firstname, $lastname, $signupdate, $mailaddress, $pwh, $activcode, $lastlogdate, $userrole]);
    }

    /**
     * return user corresponding to id or false
     */
    public function getUserFromID($id){
        foreach($usersArray as $usr){
            if ($usr->getId() == $id){
                return $usr;
            }
        }
        return false;
    }

    public function majMail($userid,$newmail){
        $sql = "UPDATE users SET mailaddress=? WHERE id=?";
        $this->connection->prepare($sql)->execute([$newmail, $userid]);
        echo "<script>alert('Mail mis à jour')</script>";
    }

}
