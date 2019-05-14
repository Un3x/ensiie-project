<?php
namespace Utility;
class Utility
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
        $rows = $this->connection->query('SELECT * FROM duo')->fetchAll(\PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $user = new Duo();
            $user
                ->setNom($row->nom)
                ->setJoueur1($row->joueur1)
                ->setJoueur2($row->joueur2)
                ->setStatut($row->statut);

            $users[] = $user;
        }

        return $users;
    }

    public function fetchClassementSolo()
    {
        $rows = $this->connection->query
            (
                'SELECT * 
                FROM joueur, participants
                WHERE joueur.nom = participants.nom
                AND participants.elo >= 0 
                ORDER BY participants.elo DESC
                '
            )->fetchAll(\PDO::FETCH_OBJ);

        /*$classement = [];
        foreach ($rows as $row) {
            $c = new Duo();
            $user
                ->setNom($row->nom)
                ->setJoueur1($row->joueur1)
                ->setJoueur2($row->joueur2)
                ->setStatut($row->statut);

            $users[] = $user;
        }*/

        return $rows;
    }

	public function fetchClassementDuo()
    {
        $rows = $this->connection->query
            (
                'SELECT * 
                FROM duo JOIN participants
                ON duo.nom = participants.nom
                ORDER BY participants.elo DESC
                '
            )->fetchAll(\PDO::FETCH_OBJ);

        return $rows;
    }


    public function fetchClassementTournoi()
    {
        $rows = $this->connection->query
            (
                'SELECT * 
                FROM tournoi, score, participants
                WHERE tournoi.nom = score.tournoi
                AND participants.nom = score.participant
                ORDER BY score.score DESC
                '
            )->fetchAll(\PDO::FETCH_OBJ);

        return $rows;
    }



}