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
                ->setMdp($row->mdp);
                //->setProfilePicture($row->pp); //pour l'avoir il faut faire une jointure avec la table : photo_profil

            $users[] = $user;
        }

        return $users;
    }

    public function listCat(){
        $rows = $this->connection->query('SELECT * FROM "categorie"')->fetchAll(\PDO::FETCH_OBJ);
        foreach ($rows as $row){
            echo"
            <a href=$row->nom_cat.php>$row->nom_cat</a>";
        }

    }


}
?>