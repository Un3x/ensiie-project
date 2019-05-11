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

    public function fetchAllParticipant()
    {
        $rows = $this->connection->query('SELECT * FROM Participant')->fetchAll(\PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $user = new User();
            $user
                ->setId($row->id)
                ->setPrenom($row->prenom)
                ->setNom($row->nom)
                ->setEmail($row->email)
                ->setPassword($row->password)
                ->setTel($row->tel)
                ->setGenre($row->genre)
                ->setSport($row->sport);

            $users[] = $user;
        }

        return $users;
    }

    public function fetchAllJury()
    {
        $rows = $this->connection->query('SELECT * FROM Jury')->fetchAll(\PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $user = new User();
            $user
                ->setId($row->id)
                ->setPrenom($row->prenom)
                ->setNom($row->nom)
                ->setEmail($row->email)
                ->setPassword($row->password)
                ->setTel($row->tel)
                ->setGenre($row->genre)
                ->setSport($row->sport);

            $users[] = $user;
        }

        return $users;
    }

    public function fetchAllOrganisateur()
    {
        $rows = $this->connection->query('SELECT * FROM Organisateur')->fetchAll(\PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $user = new User();
            $user
                ->setId($row->id)
                ->setPrenom($row->prenom)
                ->setNom($row->nom)
                ->setEmail($row->email)
                ->setPassword($row->password)
                ->setTel($row->tel)
                ->setGenre($row->genre)
                ->setSport($row->sport);

            $users[] = $user;
        }

        return $users;
    }

}
