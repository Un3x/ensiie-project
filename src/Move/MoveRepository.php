<?php

namespace Move;
class MoveRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * MoveRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * fetch every move in the database
     * @return array
     */
    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "move"')->fetchAll(\PDO::FETCH_OBJ);
        $moves = [];
        foreach ($rows as $row) {
            $move = new Move();
            $move
                ->setId($row->id)
                ->setNom($row->nom)
                ->setDifficulte($row->difficulte);

            $moves[] = $move;
        }

        return $moves;
    }

    /**
     * Gives the first move found by his name (supposed unique)
     * @param string $nom
     * @return \Move
     */
    public function fetchOneByName($nom)
    {
        $move = new Move();
        $req = 'SELECT * FROM "move" WHERE nom='.$this->connection->quote($nom);
        $rows = $this->connection->query($req)->fetch();
            $move
                ->setId($rows['id'])
                ->setNom($rows['nom'])
                ->setDifficulte($rows['difficulte']);
	        return $move;
	    
        return null;
    }

    /**
     * Gives the first move found by his id
     * @param int $id
     * @return \Move
     */
    public function fetchOneById($id)
    {
        $move = new Move();
        $req = 'SELECT * FROM "move" WHERE id='.$this->connection->quote($id);
        $rows = $this->connection->query($req)->fetch();
            $move
                ->setId($rows['id'])
                ->setNom($rows['nom'])
                ->setDifficulte($rows['difficulte']);
	        return $move;
	    
        return null;
    }

    /**
     * Add move to the database
     * @param \Move $move
     * @return boolean
     */
    public function addMove($move) {
        $nom = $move->getNom();
        $difficulte = $move->getDifficulte();
        
        $req = 'INSERT INTO "move" (nom, difficulte)
                VALUES (:nom, :diff)';
        $valeurs = ['nom'=>$nom, 'diff'=>$difficulte];
        $req_preparee = $this->connection->prepare($req);
        if (!$req_preparee->execute($valeurs)) {
            print_r($req_preparee->errorInfo());
            return false;
        }
        return true;

    }
}
