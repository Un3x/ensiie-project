<?php
namespace Logement;
class LogementRepository
{
    /**
     * LogementRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "Logement"')->fetchAll(\PDO::FETCH_OBJ);
        $logements = [];
        foreach ($rows as $row) {
            $logement = new User();
            $logement
                ->setId($row->idLogement)
                ->setUser($row->iduser)
                ->setDep($row->departement)
                ->setVille($row->ville)
                ->setNbPlaces($this->nb_places_libres)
                ->setPrix($row->prix);

            $logements[] = $logement;
        }

        return $logements;
    }   


    /**
     * Add user to the database
     * @param \Logement $user
     * @return boolean
     */
    public function addLogement($logement) 
    {
        $user = $logement->getUser();
        $dep = $logement->getDep();
        $ville = $logement->getVille();
        $NPL = $logement->getNbPlaces();
        $prix = $logement->getPrix();

        $req = 'INSERT INTO "Logements" (iduser, departement ,ville , nb_places_libres, prix)
                VALUES (:user, :departement, :ville, :NPL, :prix)';
        $valeurs = ['user'=>$iduser, 'departement'=>$departement, 'ville'=>$ville,
        'NPL'=>$nb_places_libres, 'prix'=>$prix];
        $req_preparee = $this->connection->prepare($req);
        if (!$req_preparee->execute($valeurs)) {
            print_r($req_preparee->errorInfo());
        }

    }

}