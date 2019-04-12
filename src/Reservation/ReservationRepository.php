<?php
namespace Reservation;
class ReservationRepository
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
        $rows = $this->connection->query('SELECT * FROM "Reservation"')->fetchAll(\PDO::FETCH_OBJ);
        $reservations = [];
        foreach ($rows as $row) {
            $reservation = new Reservation();
            $reservation
                ->setIdLivre($row->id_livre)
                ->setIdUser($row->id_user)
            $reservations[] = $reservation;
        }

        return $reservations;
    }

//TODO update
}
