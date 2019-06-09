<?php


namespace Clients;

class ClientsRepository
{
    private $connection;
    public function __construct(\PDO $connection)
    {
        $this->connection=$connection;
    }
    public function add(Clients $client)
    {
        $prep=$this->connection->prepare('INSERT INTO clients (ncompte,nom,prenom,datenaissance,adresse,cp,pays) VALUES (:ncompte,:nom,:prenom,:datenaissance,:adresse,:cp,:pays)');
        $prep->bindValue(':ncompte',$client->getNcompte(),\PDO::PARAM_INT);
        $prep->bindValue(':nom',$client->getNom());
        $prep->bindValue(':prenom',$client->getPrenom());
        $prep->bindValue(':datenaissance',$client->getDatenaissance());
        $prep->bindValue(':adresse',$client->getAdresse());
        $prep->bindValue(':cp',$client->getCp());
        $prep->bindValue(':pays',$client->getPays());
        return $prep->execute();
    }
    public function delete($client)
    {
        return $this->connection->exec('delete from clients where ncompte='.$client);
    }
    public function update(Clients $client)
    {
        $req=$this->connection->prepare('UPDATE clients SET nom = :nom,prenom = :prenom, datenaissance = :datenaissance , adresse = :adresse , cp = :cp ,pays = :pays WHERE ncompte = :ncompte');
        $req->bindValue(':nom', $client->getNom());

        $req->bindValue(':prenom', $client->getPrenom());
        $req->bindValue(':datenaissance', $client->getDatenaissance());
        $req->bindValue(':adresse',$client->getAdresse());
        $req->bindValue(':cp',$client->getCp(),PDO::PARAM_INT);
        $req->bindValue(':pays',$client->getPays());
        $req->bindValue(':ncompte',$client->getNcompte(),PDO::PARAM_INT);

        $req->execute();
    }
    public function allClient()
    {
        $clients=[];
        $req=$this->connection->query('select ncompte,nom,prenom,datenaissance,adresse,cp,pays from clients order by ncompte');
        while($clt=$req->fetch(\PDO::FETCH_ASSOC))
        {
            $client = new Clients();
            $client->setNcompte($clt["ncompte"]);
            $client->setNom($clt["nom"]);
            $client->setPrenom($clt["prenom"]);
            $client->setDatenaissance($clt["datenaissance"]);
            $client->setAdresse($clt["adresse"]);
            $client->setCp($clt["cp"]);
            $client->setPays($clt["pays"]);
            $clients[]=$client;
        }
        return $clients;
    }
    public function getCompte($ncompte)
    {
        $req = $this->connection->query('SELECT ncompte,nom,prenom,datenaissance,adresse,cp,pays FROM clients natural join compte WHERE nomcompte =\''.$ncompte.'\'');
        if($req) {
            $donnees = $req->fetch(\PDO::FETCH_ASSOC);
            if($donnees) {
                $client = new Clients();
                $client->setNom($donnees["nom"]);
                $client->setPrenom($donnees["prenom"]);
                $client->setDatenaissance($donnees["datenaissance"]);
                $client->setAdresse($donnees["adresse"]);
                $client->setCp($donnees["cp"]);
                $client->setPays($donnees["pays"]);
                return $client;
            }else return false;
        }else return false;
}
}