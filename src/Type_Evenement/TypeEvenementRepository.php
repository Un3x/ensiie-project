<?php


namespace TypeEvenement;


class TypeEvenementRepository
{
    private $connection;
    public function __construct(\PDO $connection)
    {
        $this->connection=$connection;
    }
    public function add(TypeEvenement $event)
    {
        $prep=$this->connection->prepare('INSERT INTO type_evenement VALUES (:eventtype,:prixheure)');
        $prep->bindValue(':eventtype',$event->getType());
        $prep->bindValue(':prixheure',$event->getPrixheure(),\PDO::PARAM_INT);
        return $prep->execute();
    }
    public function remove(TypeEvenement $event)
    {
        $this->connection->query('delete from type_evenement where eventtype='.$event->getType());
    }
    public function update(TypeEvenement $event)
    {
        $prep=$this->connection->prepare('UPDATE type_evenement set prixheure=:prixheure where eventtype=:eventtype');
        $prep->bindValue(':eventtype',$event->getType());
        $prep->bindValue(':prixheure',$event->getPrixheure(),\PDO::PARAM_INT);
        $prep->execute();
    }
    public function showAllEvents()
    {
        $events=[];
        $req=$this->connection->query('select eventtype,prixheure from type_evenement');
        while($ev=$req->fetch(\PDO::FETCH_ASSOC))
        {
            $event=new TypeEvenement();
            $event->setType($ev['eventtype']);
            $event->setPrixheure($ev['prixheure']);
            $events[]=$event;
        }
        return $events;
    }
}