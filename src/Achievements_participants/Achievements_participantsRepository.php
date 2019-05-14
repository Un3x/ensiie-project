<?php
namespace Achievements_participants;
class Achievements_participantsRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * Achievements_participants constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "achievements_participants"')->fetchAll(\PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $user = new Achievements_participants();
            $user
                ->setParticipant($row->participant)
                ->setSucces($row->succes);

            $users[] = $user;
        }

        return $users;
    }


}
