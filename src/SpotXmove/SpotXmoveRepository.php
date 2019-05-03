<?php
namespace Move;
namespace SpotXmove;
class SpotXmoveRepository
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
     * fetch every move from a spot in the database
     * @param int $spot
	 * @return array
     */
    public function fetchAllMove($spot)
    {
        $rows = $this->connection->query('SELECT * FROM "spotXmove" WHERE idSpot='.$this->connection->quote($spot))->fetchAll(\PDO::FETCH_OBJ);
		$moves = [];
		$moveRepository = new \Move\MoveRepository($this->connection);
        foreach ($rows as $row) {
            include_once("../src/Move/Move.php");
            $move = new \Move\Move();
            $move = $moveRepository->fetchOneById($row->idSpot);

            $moves[] = $move;
        }

        return $moves;
	}
	
	/**
     * fetch every spot from a move in the database
     * @param int $move
	 * @return array
     */
    public function fetchAllSpot($move)
    {
        $rows = $this->connection->query('SELECT idSpot FROM "spotXmove" WHERE idMove='.$this->connection->quote($move))->fetchAll(\PDO::FETCH_OBJ);
		$spots = [];
		$spotRepository = new \Spot\SpotRepository($this->connection);
        foreach ($rows as $row) {
            $spot = new Spot();
            $spot = $spotRepository->fetchOneById($row['idSpot']);

            $spot[] = $spot;
        }

        return $spots;
    }

    // TODO setters
}