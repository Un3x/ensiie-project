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
                ->setId($row->iduser)
                ->setpseudo($row->pseudo)
                ->setFirstname($row->firstname)
                ->setLastname($row->lastname)
                ->setBirthday(new \DateTimeImmutable($row->birthday))
                ->setmdp($row->mdp);

            $users[] = $user;
        }

        return $users;
    }

    /**
     * Add user to the database
     * @param \User $user
     * @return boolean
     */
    public function addUser($user) {
        $pseudo = $user->getpseudo();
        $firstname = $user->getFirstname();
        $lastname = $user->getLastname();
        $birthday = $user->getBirthday();
        $mdp = $user->getmdp();

        $req = 'INSERT INTO "user" (pseudo, firstname, lastname, birthday, mdp)
                VALUES (:pseudo, :prenom, :nom, :anniv, :mdp)';
        $valeurs = ['pseudo'=>$pseudo, 'prenom'=>$firstname, 'nom'=>$lastname,
        'anniv'=>$birthday, 'mdp'=>$mdp];
        $req_preparee = $this->connection->prepare($req);
        if (!$req_preparee->execute($valeurs)) {
            print_r($req_preparee->errorInfo());
        }

    }

}
