<?php
namespace Membre;
class MembreRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * MembreRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "membre"')->fetchAll(\PDO::FETCH_OBJ);
        $membres = [];
        foreach ($rows as $row) {
            $membre = new Membre();
            $membre
                ->setId($row->id_membre)
                ->setNom($row->nom)
                ->setPrenom($row->prenom)
                ->setSurnom($row->surnom)
                ->setPromo($row->promo)
                ->setRole($row->role);

            $membres[] = $membre;
        }

        return $membres;
    }
}
