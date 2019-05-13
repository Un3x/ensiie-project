<?php
namespace LogementSport;
require_once '../src/Sport/SportRepository.php';
require_once '../src/Sport/Sport.php';
class LogementSportRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * LogementRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM Logement JOIN Sport ON Logement.nom = Sport.nom')->fetchAll(\PDO::FETCH_OBJ);
        $logements = [];
        foreach ($rows as $row) {
            $logement = new LogementSport();
            $logement
                ->setAdresse($row->adresse)  
                ->setGenre($row->genre)  
                ->setNom($row->nom);


            $logements[] = $logement;
        }

        return $logements;
    }


}
