<?php
namespace Jeu;
class JeuRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * JeuRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "jeux"')->fetchAll(\PDO::FETCH_OBJ);
        $jeux = [];
        foreach ($rows as $row) {
            $jeu = new Jeu();
            $jeu
                ->setId($row->id_jeu)
                ->setTitre($row->titre)
                ->setGit($row->git)
                ->setTelechargement($row->telechargement);

            $jeux[] = $jeu;
        }

        return $jeux;
    }
    
    public function getJeu($id)
    {
        $row = $this->connection->query('SELECT * FROM "jeux" WHERE id_article = '.$id)->fetchAll(\PDO::FETCH_OBJ);
        if(count($row) == 0){
            return NULL;
        }
        
        $row = $row[0];
        $jeu = new Jeu();
        $jeu
            ->setId($row->id_jeu)
            ->setTitre($row->titre)
            ->setGit($row->git)
            ->setTelechargement($row->telechargement);
        
        return $jeu;
    }
}
