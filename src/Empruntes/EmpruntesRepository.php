<?php
namespace Empruntes;
class EmpruntesRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * ReviewRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "Empruntes"')->fetchAll(\PDO::FETCH_OBJ);
        $emprunts = [];
        foreach ($rows as $row) {
            $emprunt = new Empruntes();
            $emprunt
                ->setId($row->id);

            $emprunts[] = $emprunt;
        }

        return $emprunts;
    }

//TODO update
}