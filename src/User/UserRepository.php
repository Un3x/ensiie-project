<?php
namespace User;
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
        $rows = $this->connection->query('SELECT * FROM "user"')->fetchAll(\PDO::FETCH_OBJ);
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
                ->setActivCode($row->activcode);

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
/*         echo "UserRepository::logInWithCredentials : {<br>";
            echo "email : " . $log . '<br>';
            echo "pwd : " . $pwh .'<br>}'; */
        if(array_key_exists($log,$this->usersArray)){
            if($this->usersArray[$log]->getPasswdH() == $pwh){/* 
                echo "<br>CONNEXION OK !!  : " . $log . '<br>'; */
                return $this->usersArray[$log];
            } else {/* 
                echo "<br>CONNEXION ECHOUEE MDP !!  : " . $log . '<br>';
                echo "Vous avez entré  : " . $pwh . '<br>';
                echo "Mais il fallait  : " . $this->usersArray[$log]->getPasswdH() . '<br>'; */
                return FALSE;
            }
        } else {/* 
            echo "<br>CONNEXION ECHOUEE LOGIN !!  : " . $log . '<br>'; */
            return FALSE;
        }
    }

    public function getUserArray()
    {
        return $this->usersArray;
    }


}
