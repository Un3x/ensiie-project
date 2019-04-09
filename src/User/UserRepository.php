<?php
namespace User;
class UserRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * UserRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "user"')->fetchAll(\PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $user = new User();
            $user
                ->setId($row->id)
                ->setFirstname($row->firstname)
                ->setLastname($row->lastname)
                ->setBirthday(new \DateTimeImmutable($row->birthday))
                ->setMail($row->mail)
                ->setPassword($row->password);

            $users[] = $user;
        }

        return $users;
    }

    /**
     * Gives the first user found by his email (supposed unique)
     * @param string $login
     * @return \User
     */
    public function fetchOneByMail($login)
    {
        $user = new User();
        $req = 'SELECT * FROM "user" WHERE mail='.$this->connection->quote($login);
        $rows = $this->connection->query($req)->fetch();
            $user
                ->setId($rows['id'])
                ->setFirstname($rows['firstname'])
                ->setLastname($rows['lastname'])
                ->setBirthday(new \DateTimeImmutable($rows['birthday']))
                ->setCity($rows['city']==null ? "" : $rows['city'])
                ->setYop($rows['yop']==null ? 0 : $rows['yop'])
                ->setMail($rows['mail'])
                ->setPassword($rows['password'])
                ->setPhone($rows['phone'])
                ->setCurrent_training($rows['current_training']);
	        return $user;
	    
        return null;
    }

    /**
     * Add user to the database
     * @param \User $user
     * @return boolean
     */
    public function addUser($user) {
        $firstname = $user->getFirstname();
        $lastname = $user->getLastname();
        $birthday = $user->getBirthday();
        $city = $user->getCity();
        if ($user->getYop() == null)
            $yop = 0;
        else $yop = $user->getYop();
        $mail = $user->getMail();
        $password = $user->getPassword();
        $phone = $user->getPhone();
        $current_training = $user->getCurrent_training();

        $req = 'INSERT INTO "user" (firstname, lastname, birthday, city, yop, mail, password, phone, current_training)
                VALUES (:prenom, :nom, :anniv, :ville, :yop, :mail, :mdp, :tel, :curr_train)';
        $valeurs = ['prenom'=>$firstname, 'nom'=>$lastname, 'mail'=>$mail, 'mdp'=>$password,
                    'anniv'=>date_format($birthday, 'Y-m-d'), 'ville'=>$city, 'yop'=>$yop, 'tel'=>$phone, 'curr_train'=>$current_training];
        $req_preparee = $this->connection->prepare($req);
        if (!$req_preparee->execute($valeurs)) {
            print_r($req_preparee->errorInfo());
        }

    }
}
