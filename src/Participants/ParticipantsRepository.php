<?php
namespace Participants;
class ParticipantsRepository
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
        $rows = $this->connection->query('SELECT * FROM "participants"')->fetchAll(\PDO::FETCH_OBJ);
        $pars = [];
        foreach ($rows as $row) {
            $par = new Participants();
            $par
                ->setNom($row->nom)
                ->setElo($row->elo);

            $pars[] = $par;
        }

        return $pars;
    }


    public function updateParticipantNom($ancienNom, $nouveauNom, $elo)
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

        //$this->connection->query("UPDATE participants set nom = $nouveauNom where nom = $ancienNom");
        $this->connection->query("DELETE FROM Participants WHERE nom = $ancienNom")->fetchAll(\PDO::FETCH_OBJ);
        $this->connection->query("INSERT INTO Participants(nom,elo) VALUES ($nouveauNom,$elo)")->fetchAll(\PDO::FETCH_OBJ);

    }

}
