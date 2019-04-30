<?php

namespace User;
class CategorieRepository
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


/*function listCat(){
    $rows =$this->connection->query('SELECT * FROM "categorie"')->fetchAll(\PDO::FETCH_OBJ);
    foreach ($rows as $row){
        echo"
        <a href=\"$row->nom_cat.php\">$row->nom_cat</a>";
    }

}*/

public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "categorie"')->fetchAll(\PDO::FETCH_OBJ);
        $cats = [];
        foreach ($rows as $row) {
            $cat = new Categorie();
            $cat
                ->setId($row->id_cat)
                ->setNomCat($row->nom_cat)
                ->setLinkCat($row->link);

            $cats[] = $cat;
        }

        return $cats;
    }
}

?>