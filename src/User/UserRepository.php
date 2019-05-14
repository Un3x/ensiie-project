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
                /*->setMail($row->mail)*/
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
        /*$mail = $user->getMail();*/
        $pseudo = $user->getpseudo();
        $firstname = $user->getFirstname();
        $lastname = $user->getLastname();
        $birthday = $user->getBirthday();
        $mdp = $user->getmdp();

        $req = 'INSERT INTO "user" (/*mail,*/ pseudo, firstname, lastname, birthday, mdp)
                VALUES (/*:mail,*/ :pseudo, :prenom, :nom, :anniv, :mdp)';
        $valeurs = [/*'mail'=>$mail,*/ 'pseudo'=>$pseudo, 'prenom'=>$firstname, 'nom'=>$lastname,
        'anniv'=>$birthday, 'mdp'=>$mdp];
        $req_preparee = $this->connection->prepare($req);
        if (!$req_preparee->execute($valeurs)) {
            print_r($req_preparee->errorInfo());
        }

    }
/*
    public function usermail($iduser,$connection){
        // $email = $this->connection->query('SELECT mail FROM "user" WHERE iduser ='.$this->connection->quote($iduser) 
         $requete = "SELECT * FROM user WHERE iduser= '%$iduser%';";
         
         //$req_preparee = $this->connection->prepare($requete);
         //return $req_preparee->execute();
         return pg_query($connection,$requete);

        //return $this->connection->query('SELECT * FROM "user" WHERE "iduser=%$iduser%" ');

     }
*/
}
