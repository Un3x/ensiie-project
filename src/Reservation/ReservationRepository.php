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
                ->setIdUser($row->id_user);
            $reservations[] = $reservation;
        }

        return $reservations;
    }


    public function fetchByUser($id_user) {//retourne la liste des réservations d'un utilisateur
        $rows = $this->connection->query("SELECT * FROM \"Reservation\" WHERE id_user='$id_user';")->fetchAll(\PDO::FETCH_OBJ);
        $reservations = [];
        foreach ($rows as $row) {
            $reservation = new Reservation();
            $reservation
                ->setIdLivre($row->id_livre)
                ->setIdUser($row->id_user);
            $reservations[] = $reservation;
        }

        return $reservations;
    }


    public function okReservation($id_livre) {//retourne true si le livre peut être réservé (pas déjà réservé) et false sinon
        $rows = $this->connection->query("SELECT * FROM \"Reservation\" WHERE id_livre='$id_livre';")->fetchAll(\PDO::FETCH_OBJ);
        foreach ($rows as $row) {
            return false;
        }

        return true;
    }

//TODO update

    public function creeReservation($id_livre, $id_user) {
        $ret = new Reservation();

        $ret->setIdUser($id_user);
        $ret->setIdLivre($id_livre);

        return $ret;
    }


    public function insertReservation($reservation) {
        $id_user=$reservation->getIdUser();
        $id_livre=$reservation->getIdLivre();

        $query="INSERT INTO \"Reservation\" VALUES ('$id_livre', '$id_user');";


        $this->connection->query("$query");


        return $query;
    }


    public function deleteReservation($reservation) {
        $id_user=$reservation->getIdUser();
        $id_livre=$reservation->getIdLivre();

        $query="DELETE FROM \"Reservation\" WHERE id_livre='$id_livre' AND id_user='$id_user';";

        $this->connection->query("$query");


        return $query;
    }
}
