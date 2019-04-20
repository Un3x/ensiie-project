<?php
namespace Tuto;
class TutoRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * TutoRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "tuto"')->fetchAll(\PDO::FETCH_OBJ);
        $tutos = [];
        foreach ($rows as $row) {
            $tuto = new Tuto();
            $tuto
                ->setId($row->id_tuto)
                ->setTitre($row->titre)
                ->setTexte($row->texte)
                ->setPdf($row->pdf);

            $tutos[] = $tuto;
        }

        return $tutos;
    }
}
