<?php
namespace Matchs;
class MatchsRepository
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
        $rows = $this->connection->query('SELECT * FROM "matchs"')->fetchAll(\PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $user = new Matchs();
            $user
                ->setId($row->id)
                ->setScore1($row->score1)
                ->setScore2($row->score2)
                ->setParticipant1($row->participant1)
                ->setParticipant2($row->participant2)
                ->setTournoi($row->tournoi);

            $users[] = $user;
        }

        return $users;
    }


}
