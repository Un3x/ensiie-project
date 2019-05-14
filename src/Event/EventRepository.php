<?php
namespace Event;
class EventRepository
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
        $rows = $this->connection->query('SELECT * FROM "event"')->fetchAll(\PDO::FETCH_OBJ);
        $event = [];
        foreach ($rows as $row) {
            $event = new Event();
            $event
                ->setIdEvent($row->idevent)
                ->setTitle($row->title)
                ->setType($row->type)
                ->setDay($row->day)
                ->setStart($row->start)
                ->setPlace($row->place)
                ->setIdCreator($row->idcreator)
                ->setPublic($row->public);
            $events[] = $event;
        }

        if (isset($events)){
            return $events;
        }
        return NULL;
    }

    public function fetchmyevents(){
        $currentId = $_SESSION['currentId'];
        $rows = $this->connection->query("SELECT * FROM \"event\" e JOIN \"user\" u ON e.idcreator = u.id  WHERE u.id = $currentId")->fetchAll(\PDO::FETCH_OBJ);
        $event = [];
        foreach ($rows as $row) {
            $event = new Event();
            $event
                ->setIdEvent($row->idevent)
                ->setTitle($row->title)
                ->setType($row->type)
                ->setDay($row->day)
                ->setStart($row->start)
                ->setPlace($row->place)
                ->setIdCreator($row->idcreator)
                ->setPublic($row->public);
            $events[] = $event;
        }

        if (isset($events)){
            return $events;
        }
        return NULL;
    }

}