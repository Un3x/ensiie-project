<?php
namespace Score;
class ScoreRepository
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
        $rows = $this->connection->query('SELECT * FROM "score"')->fetchAll(\PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $user = new Score();
            $user
                ->setParticipant($row->participant)
                ->setTournoi($row->tournoi)
                ->setScore($row->score);

            $users[] = $user;
        }

        return $users;
    }


}
