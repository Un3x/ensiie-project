<?php
namespace Tournoi;
class TournoiRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * TournoiRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "tournoi"')->fetchAll(\PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $user = new Tournoi();
            $user
                ->setNom($row->nom)
                ->setDate_debut($row->date_debut);

            $users[] = $user;
        }

        return $users;
    }


}
