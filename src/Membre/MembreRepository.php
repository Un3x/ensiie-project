<?php
namespace Membre;
class MembreRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * MembreRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT id_membre, nom, prenom, surnom, promo, role FROM "membre"')->fetchAll(\PDO::FETCH_OBJ);
        $membres = [];
        foreach ($rows as $row) {
            $membre = new Membre();
            $membre
                ->setId($row->id_membre)
                ->setNom($row->nom)
                ->setPrenom($row->prenom)
                ->setSurnom($row->surnom)
                ->setPromo($row->promo)
                ->setRole($row->role);

            $membres[] = $membre;
        }

        return $membres;
    }
    
    public function getMembre($id)
    {
        $row = $this->connection->query('SELECT id_membre, nom, prenom, surnom, promo, role
                                         FROM "membre"
                                         WHERE id_membre = '.$id)->fetchAll(\PDO::FETCH_OBJ);
        if(count($row) == 0){
            return NULL;
        }
        $row = $row[0];
        $membre = new Membre();
        $membre
        ->setId($row->id_membre)
        ->setNom($row->nom)
        ->setPrenom($row->prenom)
        ->setSurnom($row->surnom)
        ->setPromo($row->promo)
        ->setRole($row->role);
        
        return $membre;
    }
    
    public function setMembre($id, $nom, $prenom, $surnom, $password, $promo, $role)
    {
        if($password == ""){
            $sql = "UPDATE membre
                    SET nom = ?, prenom = ?, surnom = ?, promo = ?, role = ?
                    WHERE id_membre = ?";
            $req = $this->connection->prepare($sql);
            $status = $req->execute(array($nom, $prenom, $surnom, $promo, $role, $id));
            return $status;
        }else{
            $password = password_hash($password, PASSWORD_BCRYPT);
            
            $sql = "UPDATE membre
                    SET nom = ?, prenom = ?, surnom = ?, password = ?, promo = ?, role = ?
                    WHERE id_membre = ?";
            $req = $this->connection->prepare($sql);
            $status = $req->execute(array($nom, $prenom, $surnom, $password, $promo, $role, $id));
            return $status;
        }
    }
    
    public function getMembrePassword($id)
    {
        $row = $this->connection->query('SELECT password
                                         FROM "membre"
                                         WHERE id_membre = '.$id)->fetchAll(\PDO::FETCH_OBJ);
        if(count($row) == 0){
            return NULL;
        }
        $row = $row[0];
        
        return $row->password;
    }
    
    public function setMembrePassword($id, $password)
    {
        $password = password_hash($password);
        
        $sql = "UPDATE membre
                SET password = ?
                WHERE id_membre = ?";
        $req = $this->connection->prepare($sql);
        $status = $req->execute(array($password, $id));
        return $status;
    }
    
    public function deleteMembre($id)
    {
        $sql = "DELETE FROM membre
                WHERE id_membre = ?";
        $req = $this->connection->prepare($sql);
        $status = $req->execute(array($id));
        return $status;
    }
    
    public function createMembre($nom, $prenom, $surnom, $password, $promo, $role)
    {
        $password = password_hash($password);
        
        $sql = "INSERT INTO membre
                (nom, prenom, surnom, password, promo, role) VALUES (?, ?, ?, ?, ?, ?);";
        $req = $this->connection->prepare($sql);
        $status = $req->execute(array($nom, $prenom, $surnom, $password, $promo, $role));
        return $status;
    }
}
