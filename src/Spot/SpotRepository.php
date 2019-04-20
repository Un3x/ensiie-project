<?php
namespace Spot;
class SpotRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * SpotRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * fetch every Spot in the database
     * @return array
     */
    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "spot"')->fetchAll(\PDO::FETCH_OBJ);
        $spots = [];
        foreach ($rows as $row) {
            $spot = new Spot();
            $spot
                ->setId($row->id)
                ->setNom($row->nom)
                ->setLatitude($row->latitude)
                ->setLongitude($row->longitude)
                ->setNote($row->note);

            $spots[] = $spot;
        }

        return $spots;
    }

    /**
     * Gives the first spot found by his name (supposed unique)
     * @param string $nom
     * @return \Spot
     */
    public function fetchOneByName($nom)
    {
        $spot = new Spot();
        $req = 'SELECT * FROM "spot" WHERE nom='.$this->connection->quote($nom);
        $rows = $this->connection->query($req)->fetch();
            $spot
                ->setId($rows['id'])
                ->setNom($rows['nom'])
                ->setLatitude($rows['latitude'])
                ->setLongitude($rows['longitude'])
                ->setNote($rows['note']==null ? 0 : $rows['note']);
	        return $spot;
	    
        return null;
    }

    /**
     * Gives the first spot found by his id
     * @param int $id
     * @return \Spot
     */
    public function fetchOneById($id)
    {
        $spot = new Spot();
        $req = 'SELECT * FROM "spot" WHERE id='.$this->connection->quote($id);
        $rows = $this->connection->query($req)->fetch();
            $spot
                ->setId($rows['id'])
                ->setNom($rows['nom'])
                ->setLatitude($rows['latitude'])
                ->setLongitude($rows['longitude'])
                ->setNote($rows['note']==null ? 0 : $rows['note']);
	        return $spot;
	    
        return null;
    }

    /**
     * Add spot to the database
     * @param \Spot $spot
     * @return boolean
     */
    public function addSpot($spot) {
        $nom = $spot->getNom();
        $latitude = $spot->getLatitude();
        $longitude = $spot->getLongitude();
        if ($spot->getNote() == null)
            $note = 0;
        else $note = $spot->getNote();
        
        $req = 'INSERT INTO "spot" (nom, latitude, longitude, note)
                VALUES (:nom, :lat, :long, :note)';
        $valeurs = ['nom'=>$nom, 'lat'=>$latitude, 'long'=>$longitude, 'note'=>$note];
        $req_preparee = $this->connection->prepare($req);
        if (!$req_preparee->execute($valeurs)) {
            print_r($req_preparee->errorInfo());
            return false;
        }
        return true;

    }
}
