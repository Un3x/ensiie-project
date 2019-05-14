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

    public function id_all()
    {
        $rows = $this->connection->query('SELECT * FROM "Identite"') -> fetchAll(\PDO::FETCH_OBJ);

        $user=[];
        foreach ($rows as $row) {
            $user_temp = new Identite();
            $user_temp
                ->setNom($row->nom)
                ->setPrenom($row->prenom)
                ->setVille($row->ville)
                ->setRegion($row->region)
                ->setSexe($row->sexe)
                ->setNote($row->note)
                ->setPseudo($row->pseudo)
                ->setPhrase($row->phrase);
            $user[]=$user_temp;
        }
        return $user;
    }

    public function com_all(){
        $query= 'SELECT * FROM "Commentaire"';
        $rows = $this->connection->query($query) -> fetchAll(\PDO::FETCH_OBJ);
        $coms=[];
        foreach($rows as $row) {
            $com_temp=new Commentaire();
            $com_temp
                ->setCommentaire($row->commentaire)
                ->setCommentateur($row->commentateur)
                -> setDat($row->dat)
                -> setHeur($row->heur);
            $coms[]=$com_temp;

        }
        return $coms;
    }

}




