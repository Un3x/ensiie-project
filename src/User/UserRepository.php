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
            ->setPseudo($row->pseudo)
            ->setMdp($row->mdp)
            ->setPrenom($row->prenom)
            ->setNom($row->nom)
            ->setStatut($row->statut)
            ->setMail($row->mail);

            $users[] = $user;
        }

        return $users;
    }

}
