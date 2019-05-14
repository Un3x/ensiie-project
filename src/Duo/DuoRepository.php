<?php
namespace Duo;
class DuoRepository
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
        $rows = $this->connection->query('SELECT * FROM "duo"')->fetchAll(\PDO::FETCH_OBJ);
        $duos = [];
        foreach ($rows as $row) {
            $duo = new Duo();
            $duo
                ->setNom($row->nom)
                ->setJoueur1($row->joueur1)
                ->setJoueur2($row->joueur2)
                ->setStatut($row->statut);

            $duos[] = $duo;
        }

        return $duos;
    }

    public function avgElo($elo1, $elo2){
        return ($elo1 + $elo2) / 2.0;
    }


}
