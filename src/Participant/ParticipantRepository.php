<?php
namespace Participant;
class ParticipantRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * @var bool
     
    private $connected = false;
    */

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
        $rows = $this->connection->query('SELECT * FROM "participant"')->fetchAll(\PDO::FETCH_OBJ);
        $participants = [];
        foreach ($rows as $row) {
            $participant = new Participant();
            $participant
                ->setKey($row->key)
                ->setIdEvent($row->idevent)
                ->setIdUser($row->iduser)
                ->setPseudo($row->pseudo);

            $participants[] = $participant;
        }

        return $participants;
    }

    public function fetch($idevent)
    {
        $sql = "SELECT * FROM \"participant\" WHERE idevent=$idevent";
        $participants = [];
        foreach ($this->connection->query($sql) as $row) {
            $participant = new Participant();
            $participant
                ->setKey($row['key'])
                ->setIdEvent($row['idevent'])
                ->setIdUser($row['iduser'])
                ->setPseudo($row['pseudo']);

            $participants[] = $participant;
        }

        return $participants;
    }

}
