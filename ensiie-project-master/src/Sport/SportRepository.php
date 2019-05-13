<?php
namespace Sport;
require '../src/User/UserRepository.php';
require '../src/User/User.php';
class SportRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * SportRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM Sport')->fetchAll(\PDO::FETCH_OBJ);
        $sports = [];
        foreach ($rows as $row) {
            $sport = new Sport();
            $sport
                ->setNom($row->nom)
                ->setLieu($row->lieu)
                ->setGenre($row->genre);


            $sports[] = $sport;
        }

        return $sports;
    }

    public function fetchAllUsers()
    {
        $rows = $this->connection->query('SELECT Participant.nom AS unom, Participant.prenom, Participant.genre, Participant.sport, Sport.nom, Sport.lieu, Sport.genre FROM Participant JOIN Sport ON Participant.sport = Sport.nom WHERE Participant.genre = Sport.genre')->fetchAll(\PDO::FETCH_OBJ);
        return $rows;
    }


}
