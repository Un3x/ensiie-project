<?php


namespace Compte;

class CompteRepository
{
    private $connection;
    public function __construct(\PDO $connection)
    {
        $this->connection=$connection;
    }
    public function add(Compte $compte)
    {
        if($compte==null)
        {
            echo "sthawa";
        }
        else {
            $prep = $this->connection->prepare('INSERT INTO compte (nomcompte,motpasse,email) VALUES (:nom,:motpasse,:email)');
            $prep->bindValue(':nom', $compte->getNomcompte());
            $prep->bindValue(':motpasse', $compte->getMotpasse());
            $prep->bindValue(':email', $compte->getEmail());
            return ($prep->execute());
        }
    }
    public function delete($compte)
    {
        return $this->connection->exec('delete from compte where ncompte='.$compte);
    }
    public function update(Compte $compte)
    {
        $req=$this->connection->prepare('UPDATE compte SET nomcompte = :nomcompte, motpasse = :motpasse, email = :email WHERE ncompte = :ncompte');
        $req->bindValue(':nomcompte', $compte->getNomcompte());

        $req->bindValue(':motpasse', $compte->getMotpasse());

        $req->bindValue(':email', $compte->getEmail());

        $req->bindValue(':ncompte',$compte->getNcompte(),PDO::PARAMINT);
        $req->execute();
    }
    public function allCompte()
    {
        $comptes=array();
        $req=$this->connection->query('select ncompte,nomcompte,motpasse,email from compte order by ncompte');
        $nb=0;
        while($cpt=$req->fetch(\PDO::FETCH_ASSOC))
        {
            $comptes[$nb]=(new Compte())->hydrate($cpt);
            $nb++;
        }
        return $comptes;
    }
    public function getCompte($ndc,$mdp)
    {
        $req = $this->connection->query('SELECT ncompte,nomcompte,motpasse,email FROM compte WHERE nomcompte=\''.$ndc.'\' and motpasse=\''.$mdp.'\'');
        if($req) {
            $donnees=$req->fetch(\PDO::FETCH_ASSOC);
            if($donnees) {
                $sonCompte=new Compte();
                $sonCompte->setNcompte($donnees["ncompte"]);
                $sonCompte->setEmail($donnees["email"]);
                $sonCompte->setNomcompte($donnees["nomcompte"]);
                $sonCompte->setMotpasse($donnees["email"]);
                return $sonCompte;
            }
            else false;
        }
        else false;

    }
}