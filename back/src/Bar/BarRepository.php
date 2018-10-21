<?php
namespace Bar;

class BarRepository
{
    private $connection;
    private $BarHydrator;

    public function __construct($connection, BarHydrator $BarHydrator)
    {
        $this->connection = $connection;
        $this->BarHydrator = $BarHydrator;
    }

    public function fetchAll()
    {
        $Bars = $this->connection
            ->query('SELECT * FROM "bar"')
            ->fetchAll(\PDO::FETCH_CLASS, Bar::class);

        return $Bars;
    }

    public function fetchById($id)
    {
        $request = $this->connection->prepare('SELECT * FROM "bar" where id=:id');
        $request->bindParam(':id',$id, \PDO::PARAM_INT);
        $request->execute();
        $bars = $request->fetchAll(\PDO::FETCH_CLASS, Bar::class);
        if(count($bars) > 0)
        {
            return $bars[0];
        }
        else
        {
            return NULL;
        }
    }

}
