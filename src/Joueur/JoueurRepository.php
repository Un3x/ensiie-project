<?php
namespace Joueur;
class JoueurRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * JoueurRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "joueur"')->fetchAll(\PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $user = new Joueur();
            $user
                ->setNom($row->nom)
                ->setRang($row->rang)
                ->setPromotion($row->promotion)
                ->setPassword($row->password);

            $users[] = $user;
        }

        return $users;
    }

    public function updateJoueurNom($ancienNom, $nouveauNom)
    {
        /*$rows = $this->connection->query('SELECT * FROM "joueur"')->fetchAll(\PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $user = new Joueur();
            $user
                ->setNom($row->nom)
                ->setRang($row->rang)
                ->setPromotion($row->promotion)
                ->setPassword($row->password);

            $users[] = $user;
        }

        return $users;*/

        $this->connection->query("UPDATE joueur set nom = $nouveauNom where nom = $ancienNom");

    }


}
