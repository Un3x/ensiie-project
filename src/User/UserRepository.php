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
        $rows = $this->connection->query('SELECT * FROM "utilisateur"')->fetchAll(\PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $user = new User();
            $user
                ->setId($row->id)
                ->setFirstname($row->firstname)
                ->setLastname($row->lastname)
                ->setBirthday(new \DateTimeImmutable($row->birthday))
                ->setLocation($row->loc)
                ->setMail($row->mail)
                ->setMdp($row->mdp)
                //->setProfilePicture($row->pp); //pour l'avoir il faut faire une jointure avec la table : photo_profil
                ->setAdministrateur($row->administrateur);

            $users[] = $user;
        }

        return $users;
    }

    public function searchUser($search){
        $rows=$this->connection->query("SELECT * FROM \"utilisateur\" WHERE id LIKE '%".$search."%' OR firstname LIKE '%".$search."%' OR lastname LIKE '%".$search."%' ")->fetchAll(\PDO::FETCH_OBJ);
        $users=[];
        foreach ($rows as $row) {
            $user = new User();
            $user
                ->setId($row->id)
                ->setFirstname($row->firstname)
                ->setLastname($row->lastname)
                ->setBirthday(new \DateTimeImmutable($row->birthday))
                ->setLocation($row->loc)
                ->setMail($row->mail)
                ->setMdp($row->mdp);
            $users[] = $user;
        }
        return $users;

    }

    public function testmail($mailtest){
        $rows=$this->connection->query("SELECT * FROM \"utilisateur\" WHERE mail='".$mailtest."';")->fetchAll(\PDO::FETCH_OBJ);
        $users=[];
        foreach ($rows as $row) {
            $user = new User();
            $user
                ->setId($row->id)
                ->setFirstname($row->firstname)
                ->setLastname($row->lastname)
                ->setBirthday(new \DateTimeImmutable($row->birthday))
                ->setLocation($row->loc)
                ->setMail($row->mail)
                ->setMdp($row->mdp);
            $users[] = $user;
        }
        return $users;

    }

    public function testpseudo($pseudotest){
        $rows=$this->connection->query("SELECT * FROM utilisateur WHERE id='".$pseudotest."';")->fetchAll(\PDO::FETCH_OBJ);
        $users=[];
        foreach ($rows as $row) {
            $user = new User();
            $user
                ->setId($row->id)
                ->setFirstname($row->firstname)
                ->setLastname($row->lastname)
                ->setBirthday(new \DateTimeImmutable($row->birthday))
                ->setLocation($row->loc)
                ->setMail($row->mail)
                ->setMdp($row->mdp);
            $users[] = $user;
        }
        return $users;

    }


}
?>