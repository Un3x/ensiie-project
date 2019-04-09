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
                ->setBirthday(new \DateTimeImmutable($row->birthday));

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
    	$rows = $this->connection->query('SELECT * FROM "user" WHERE mail='.$login)->fetchAll(\PDO::FETCH_OBJ);
    	if ($rows) {
            $user = new User();
            $user
                ->setId($rows[0]->id)
                ->setFirstname($rows[0]->firstname)
                ->setLastname($rows[0]->lastname)
                ->setBirthday($rows[0]->birthday)
                ->setCity($rows[0]->city)
                ->setYop($rows[0]->yop)
                ->setMail($rows[0]->mail)
                ->setPassword($rows[0]->password)
                ->setPhone($rows[0]->phone)
                ->setCurrent_training($rows[0]->current_training);
	        return $user;
	    }
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
        if ($user->getBirthday() != null) {
        $birthday = $user->getBirthday(); }
        $city = $user->getCity();
        $yop = $user->getYop();
        $mail = $user->getMail();
        $password = $user->getPassword();
        $phone = $user->getPhone();
        $current_training = $user->getCurrent_training();

        $req = 'INSERT INTO "user" (firstname, lastname, birthday, city, yop, mail, password, phone, current_training)
                VALUES (:prenom, :nom, :anniv, :ville, :yop, :mail, :mdp, :tel, :curr_train)';
        $valeurs = ['prenom'=>$firstname];
        $this->connection->prepare($requete)->execute($valeurs);

    }
}
