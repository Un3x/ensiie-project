<?php

namespace Admin;

class AdminRepository
{
    private $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function add(Admin $admin)
    {
        $prep = $this->connection->prepare('INSERT INTO admin (ncompte,nom,prenom,datenaissance,adresse,cp,pays) VALUES (:ncompte,:nom,:prenom,:datenaissance,:adresse,:cp,:pays)');
        $prep->bindValue(':ncompte', $admin->getNcompte(), \PDO::PARAM_INT);
        $prep->bindValue(':nom', $admin->getNom());
        $prep->bindValue(':prenom', $admin->getPrenom());
        $prep->bindValue(':datenaissance', $admin->getDatenaissance());
        $prep->bindValue(':adresse', $admin->getAdresse());
        $prep->bindValue(':cp', $admin->getCp(),\PDO::PARAM_INT);
        $prep->bindValue(':pays', $admin->getPays());
        return $prep->execute();
    }

    public function delete(Admin $admin)
    {
        $this->connection->exec('delete from admin where ncompte=' . $admin->getNcompte());
    }

    public function update(Admin $admin)
    {
        $req = $this->connection->prepare('UPDATE admin SET nom = :nom,prenom = :prenom, datenaissance = :datenaissance , adresse = :adresse , cp = :cp ,pays = :pays WHERE ncompte = :ncompte');
        $req->bindValue(':nom', $admin->getNom());

        $req->bindValue(':prenom', $admin->getPrenom());
        $req->bindValue(':datenaissance', $admin->getDatenaissance());
        $req->bindValue(':adresse', $admin->getAdresse());
        $req->bindValue(':cp', $admin->getCp(), PDO::PARAM_INT);
        $req->bindValue(':pays', $admin->getPays());
        $req->bindValue(':ncompte', $admin->getNcompte(), PDO::PARAM_INT);

        $req->execute();
    }

    public function allAdmin()
    {
        $admins = [];
        $req = $this->connection->query('select ncompte,nom,prenom,datenaissance,adresse,cp,pays from admin order by ncompte');
        while ($adm = $req->fetch(\PDO::FETCH_ASSOC)) {
            $adminos=new Admin();
            $adminos->setNcompte($adm['ncompte']);
            $adminos->setNom($adm['nom']);
            $adminos->setPrenom($adm['prenom']);
            $adminos->setDatenaissance($adm['datenaissance']);
            $adminos->setAdresse($adm['adresse']);
            $adminos->setCp($adm['cp']);
            $adminos->setPays($adm['pays']);

            $admins[] = $adminos;
        }
        return $admins;
    }

    public function getAdmin($admin)
    {
        $req = $this->connection->query('SELECT ncompte,nom,prenom,datenaissance,adresse,cp,pays FROM admin natural join compte WHERE nomcompte =\''.$admin.'\'');
        if ($req) {
            $donnees = $req->fetch(\PDO::FETCH_ASSOC);
            if ($donnees) {
                $admin=new Admin();
                $admin->setNom($donnees["nom"]);
                $admin->setPrenom($donnees["prenom"]);
                $admin->setDatenaissance($donnees["datenaissance"]);
                $admin->setAdresse($donnees["adresse"]);
                $admin->setCp($donnees["cp"]);
                $admin->setPays($donnees["pays"]);
                return $admin;
            }
            return false;
        }
        else return false;
    }
}