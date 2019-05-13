<?php
namespace Logement;
require_once '../src/Sport/SportRepository.php';
require_once '../src/Sport/Sport.php';
class LogementRepository
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
        $rows = $this->connection->query('SELECT * FROM Logement')->fetchAll(\PDO::FETCH_OBJ);
        $logements = [];
        foreach ($rows as $row) {
            $logement = new Sport();
            $logement
                ->setAdresse($row->adresse);    


            $logements[] = $logement;
        }

        return $logements;
    }


}
