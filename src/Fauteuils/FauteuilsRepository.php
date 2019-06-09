<?php

namespace Fauteuils;

class FauteuilsRepository
{
    private $connection;
    public function __construct($connection)
    {
        $this->connection=$connection;
    }
    public function add(Fauteuils $fauteuil)
    {
        $prep=$this->connection->prepare('INSERT INTO fauteuils (nfauteuil,catplace) VALUES (:nfauteuil,:catplace)');
        $prep->bindValue(':nfauteuil',$fauteuil->getNfauteuil(),\PDO::PARAM_INT);
        $prep->bindValue(':catplace',$fauteuil->getCatplace(),\PDO::PARAM_INT);
        return $prep->execute();
    }
    public function delete(Fauteuils $fauteuil)
    {
        $this->connection->query("DELETE from fauteuils where nfauteuil=".$fauteuil->getNfauteuil());
    }
    //on suppose que on peut pas modifier la catégorie des fauteuils
    public function allFauteuilsOf(Fauteuils $fauteuil)
    {
        $fauteuils=[];
        $req=$this->connection->query('select nfauteuil from fauteuils where catplace=:catplace ');
        while($nf=$req->fetch(PDO::FETCH_ASSOC))
        {
            $fauteuils[]=(new Fauteuils())->hydrate($nf);
        }
        return $fauteuils;
    }
    public function allFauteuils()
    {
        $fauteuils=[];
        $req=$this->connection->query('select nfauteuil from fauteuils');
        while($nf=$req->fetch(\PDO::FETCH_ASSOC))
        {
            $fauteuils[]=(new Fauteuils())->hydrate($nf);
        }
        return $fauteuils;
    }
    // getCategorieOf() n'est pas utils

}