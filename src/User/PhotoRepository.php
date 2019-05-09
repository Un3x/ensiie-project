<?php

namespace User;
class PhotoRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * UserRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }



public function fetchAll()

    {
        $rows = $this->connection->query("SELECT * FROM photo;")->fetchAll(\PDO::FETCH_OBJ);
        $cats = [];
        foreach ($rows as $row) {
            $cat = new Photo();
            $cat
                ->setId($row->id_photo)
                ->setExt($row->extension);

            $cats[] = $cat;
        }

        return $cats;
    }

public function getMax()
{
    $rows=$this->connection->query("SELECT MAX(id_photo) FROM photo;")->fetchAll(\PDO::FETCH_OBJ);
    $c=0;
    foreach($rows as $row){
        $c=$c+($row->max);
    }

    return $c;

}
}

?>
