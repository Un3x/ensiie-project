<?php
namespace Forum;
class ForumRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * ForumRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "Forum"')->fetchAll(\PDO::FETCH_OBJ);
        $forums = [];
        foreach ($rows as $row) {
            $forum = new Forum();
            $forum
                ->setIdForum($row->id_forum)
                ->setNom($row->nom)
                ->setVille($row->ville)
                ->setDate($row->f_date);

            $forums[] = $forum;
        }

        return $forums;
    }

    public function fetchInit()
    {
        $rows = $this->connection->query('SELECT * FROM "Forum"')->fetchAll(\PDO::FETCH_OBJ);
        $forums = [];
        foreach ($rows as $row) {
            $forum = new Forum();
            $forum
                ->setNom($row->nom)
                ->setVille($row->ville)
                ->setDate($row->f_date);

            $forums[] = $forum;
        }

        return $forums;
    }

    public function queryForum($forum) {
        $nom = $forum->getNom();
        $ville = $forum->getVille();
        $f_date = $forum->getDate();
        
        $req = 'INSERT INTO "Forum" (nom, ville, f_date)
                VALUES (:nom, :ville, :f_date)';
        $valeurs = ['nom'=>$nom, 'ville'=>$ville, 'f_date'=>$f_date];
        $req_prepare = $this->connection->prepare($req);
        if (!$req_prepare->execute($valeurs)) {
            print_r($req_prepare->errorInfo());
            return false;
        }
        return true;
    }

    public function fetchForumById($id_forum)
    {
        $rows = $this->connection->query('SELECT * FROM "Forum" WHERE id_forum ='.$this->connection->quote($id_forum))->fetchAll(\PDO::FETCH_OBJ);
        if ($rows == null) {
            return null;
        } 
        foreach ($rows as $row) {
            $forum = new Forum();
            $forum
                ->setIdForum($row->id_forum)
                ->setNom($row->nom)
                ->setVille($row->ville)
                ->setDate($row->f_date);
        }
        return $forum;
    }

    public function deleteForumById($id)
    {
        return $this->connection->query('DELETE FROM "Forum" WHERE id_forum ='.$this->connection->quote($id));
    }

    public function participation($id_eleve) {
        $rows = $this->connection->query('SELECT * FROM "Forum" NATURAL JOIN "Participant" WHERE id_eleve ='.$this->connection->quote($id_eleve))->fetchAll(\PDO::FETCH_OBJ);
        $forums = [];
        if ($rows == null) {
            return null;
        } 
        foreach ($rows as $row) {
            $forum = new Forum();
            $forum
                ->setIdForum($row->id_forum)
                ->setNom($row->nom)
                ->setVille($row->ville)
                ->setDate($row->f_date);

                $forums[] = $forum;
        }
        return $forums;
    }

    

}
