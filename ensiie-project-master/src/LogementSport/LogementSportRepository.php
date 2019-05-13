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
        $rows = $this->connection->query('SELECT * FROM Logement, Sport')->fetchAll(\PDO::FETCH_OBJ);
        $logements = [];
        foreach ($rows as $row) {
            $logement = new LogementSport();
            if (($row->genre == 'f' && $row->adresse == 'Chambre') || ($row->genre == 'm' && $row->adresse == 'Tente')) {

                $logement
                    ->setAdresse($row->adresse)  
                    ->setGenre($row->genre)  
                    ->setNom($row->nom);

                $logements[] = $logement;
            }
        }

        return $logements;
    }


}
?>
