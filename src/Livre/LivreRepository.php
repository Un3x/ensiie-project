<?php
namespace Livre;
class LivreRepository
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
        $rows = $this->connection->query('SELECT * FROM "Livre"')->fetchAll(\PDO::FETCH_OBJ);
        $livres = [];
        foreach ($rows as $row) {
            $livre = new Livre();
            $livre
                ->setId($row->id)
                ->setTitre($row->titre)
                ->setAuteurs($row->auteur) //TODO ALED
                ->setPublication(new \DateTimeImmutable($row->publication))
                ->setImage($row->couverture)
                ->setEdition($row->edition);

            $livres[] = $livre;
        }

        return $users;
    }

//TODO update
}
