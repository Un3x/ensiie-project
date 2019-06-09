<?php


namespace ReservationSalle;


class ReservationSalleRepository
{
    private $connection;
    public function __construct(\PDO $connection)
    {
        $this->connection=$connection;
    }
    public function add(ReservationSalle $place)
    {
        $prep=$this->connection->prepare('INSERT INTO reservation_salle (planing,client,typeevenement,nomevenement) VALUES (:planing,:client,:typeevenement,:nomevenement)');
        $prep->bindValue(':planing',$place->getPlaning(),\PDO::PARAM_INT);
        $prep->bindValue(':client',$place->getClient(),\PDO::PARAM_INT);
        $prep->bindValue(':typeevenement',$place->getTypeevenement());
        $prep->bindValue(':nomevenement',$place->getNomevenement());

        return $prep->execute();
    }
    public function remove($place)
    {
        return $this->connection->query('delete from reservation_salle where nreservation='.$place);
    }
    public function update(ReservationPlace $place)
    {
        $prep=$this->connection->prepare('UPDATE reservation_salle SET planing=:planing,client=:client,typeevenement=:typeevenement,nomevenement=:nomevenement where nreservation=:nreservation');
        $prep->bindValue(':nreservation',$place->getNreservation(),\PDO::PARAM_INT);
        $prep->bindValue(':planing',$place->getPlaning(),\PDO::PARAM_INT);
        $prep->bindValue(':client',$place->getClient(),\PDO::PARAM_INT);
        $prep->bindValue(':typeevenement',$place->getTypeevenement());
        $prep->bindValue(':nomevenement',$place->getNomevenement());
        $prep->execute();
    }
    public function allReservationOfPlaning($planing)
    {
        $reservations=[];
        $req=$this->connection->query('select nreservation,planing,client,typeevenement,nomevenement from reservation_salle where planing='.$planing);
        while($rp=$req->fetch(PDO::FETCH_ASSOC))
        {
            $reservations[]=(new ReservationSalle())->hydrate($rp);
        }
        return $reservations;
    }
    public function allReservationOfCLient($client)
    {
        $reservations=[];
        $req=$this->connection->query('select nreservation,planing,client,typeevenement,nomevenement from reservation_salle where client='.$client);
        while($rp=$req->fetch(\PDO::FETCH_ASSOC))
        {
            $reservations[]=(new ReservationSalle())->hydrate($rp);
        }
        return $reservations;
    }
    public function allReservationOfdate($date)
    {
        $planings=(new \Planing\PlaningRepository())->showPlaningOfDate($date);
        $reservation=[];
        $req=$this->connection->prepare('select nreservation,planing,client,typeevenement,nomevenement from reservation_salle where planing=:planing');
        foreach ($planings as $planing)
        {
            $req->bindValue(':planing',$planing->getNplaning(),\PDO::PARAM_INT);
            $req->execute();
            $rp=$req->fetch(\PDO::FETCH_ASSOC);
            $reservation[]=(new ReservationPlace())->hydrate($rp);
        }
        return $reservation;
    }
    public function allReservation()
    {
        $reservations=[];
        $req=$this->connection->query('select nreservation,planing,client,typeevenement,nomevenement from reservation_salle');
        while($rp=$req->fetch(\PDO::FETCH_ASSOC))
        {
            $reserver=new ReservationSalle();
            $reserver->setNreservation($rp['nreservation']);
            $reserver->setClient($rp['client']);
            $reserver->setTypeevenement($rp['typeevenement']);
            $reserver->setNomevenement($rp['nomevenement']);
            $reserver->setPlaning($rp['planing']);
            $reservations[]=$reserver;
        }
        return $reservations;
    }
}