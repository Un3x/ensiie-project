<?php
namespace Reservation;
class ReservationRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * ReservationRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "Reservation"')->fetchAll(\PDO::FETCH_OBJ);
        $Reservation = [];
        foreach ($rows as $row) {
            $Reservation = new Reservation();
            $Reservation
                ->setId($row->id)
                ->setPrenom($row->prenom)
                ->setNom($row->nom)
                ->setEmail($row->email);

            $Reservation[] = $Reservation;
        }

        return $Reservation;
    }


}
