<?php


namespace ReservationPlace;


use Planing\Planing;
use Planing\PlaningRepository;

class ReservationPlaceRepository
{
    private $connection;
    public function __construct(\PDO $connection)
    {
        $this->connection=$connection;
    }
    public function add(ReservationPlace $place)
    {
        $prep=$this->connection->prepare('INSERT INTO reservation_place (planing,client,fauteuil)VALUES (:planing,:client,:fauteuil)');
        $prep->bindValue(':planing',$place->getPlaning(),\PDO::PARAM_INT);
        $prep->bindValue(':client',$place->getClient(),\PDO::PARAM_INT);
        $prep->bindValue(':fauteuil',$place->getFauteuil(),\PDO::PARAM_INT);
        return $prep->execute();
    }
    public function remove($place)
    {
        return $this->connection->query('delete from reservation_place where nreservation='.$place);
    }
    public function update(ReservationPlace $place)
    {
        $prep=$this->connection->prepare('UPDATE reservation_place SET planing=:planing,client=:client,fauteuil=:fauteuil where nreservation=:nreservation');
        $prep->bindValue(':nreservation',$place->getNreservation(),\PDO::PARAM_INT);
        $prep->bindValue(':planing',$place->getPlaning(),\PDO::PARAM_INT);
        $prep->bindValue(':client',$place->getClient(),\PDO::PARAM_INT);
        $prep->bindValue(':fauteuil',$place->getFauteuil(),\PDO::PARAM_INT);
        $prep->execute();
    }
    public function allReservationOfPlaning($planing)
    {
        $reservations=[];
        $req=$this->connection->query('select nreservation,planing,client,fauteuil from reservation_place where planing='.$planing);
        while($rp=$req->fetch(\PDO::FETCH_ASSOC))
        {
            $reservations[]=(new ReservationPlace())->hydrate($rp);
        }
        return $reservations;
    }
    public function allReservation()
    {
        $reservations=[];
        $req=$this->connection->query('select nreservation,planing,client,fauteuil from reservation_place');
        while($rp=$req->fetch(\PDO::FETCH_ASSOC))
        {
            $reserver=new ReservationPlace();
            $reserver->setClient($rp['client']);
            $reserver->setFauteuil($rp['fauteuil']);
            $reserver->setNreservation($rp['nreservation']);
            $reserver->setPlaning($rp['planing']);
            $reservations[]=$reserver;
        }
        return $reservations;
    }
    public function allReservationOfCLient($client)
    {
        $reservations=[];
        $req=$this->connection->query('select nreservation,planing,client,fauteuil from reservation_place where client='.$client);
        while($rp=$req->fetch(\PDO::FETCH_ASSOC))
        {
            $reserver=new ReservationPlace();
            $reserver->setClient($rp['client']);
            $reserver->setFauteuil($rp['fauteuil']);
            $reserver->setNreservation($rp['nreservation']);
            $reserver->setPlaning($rp['planing']);
            $reservations[]=$reserver;
        }
        return $reservations;
    }
    public function allReservationOfdate($date)
    {
        $planings=(new \Planing\PlaningRepository())->showPlaningOfDate($date);
        $reservation=[];
        $req=$this->connection->prepare('select nreservation,planing,client,fauteuil from reservation_place where planing=:planing');
        foreach ($planings as $planing)
        {
            $req->bindValue(':planing',$planing->getNplaning(),\PDO::PARAM_INT);
            $req->execute();
            $rp=$req->fetch(\PDO::FETCH_ASSOC);
            $reservation[]=(new ReservationPlace())->hydrate($rp);
        }
        return $reservation;
    }
    public function nombreReservation($id)
    {
        $nb=$this->connection->query("select count(nreservation) from reservation_place where client=".$id);
        if($nb==true) {
            $res = $nb->fetch(\PDO::FETCH_ASSOC);
            return $res['count'];
        }else
        {
            return false;

        }
    }
}