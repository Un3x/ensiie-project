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
                ->setTelechargement($row->telechargement)
				->setDescription($row->description);

            $jeux[] = $jeu;
        }

        return $jeux;
    }
    
    public function getJeu($id)
    {
        $row = $this->connection->query('SELECT * FROM "jeux" WHERE id_jeu = '.$id)->fetchAll(\PDO::FETCH_OBJ);
        if(count($row) == 0){
            return NULL;
        }
        
        $row = $row[0];
        $jeu = new Jeu();
        $jeu
            ->setId($row->id_jeu)
            ->setTitre($row->titre)
            ->setGit($row->git)
            ->setTelechargement($row->telechargement)
			->setDescription($row->description);
        
        return $jeu;
    }
    
    public function setJeu($id, $titre, $git, $telechargement, $description)
    {
        $sql = "UPDATE jeux
                SET titre = ?, git = ?, telechargement = ?, description = ?
                WHERE id_jeu = ?";
        $req = $this->connection->prepare($sql);
        $status = $req->execute(array($titre, $git, $telechargement, $description, $id));
        return $status;
    }
    
    public function deleteJeu($id)
    {
        $sql = "DELETE FROM jeux
                WHERE id_jeu = ?";
        $req = $this->connection->prepare($sql);
        $status = $req->execute(array($id));
        return $status;
	}
	
	public function getIdJeu( $titre )
	{
		echo "<p>$titre</p>";
		$res = $this->connection->query('SELECT id_jeu FROM jeux WHERE titre = \''.$titre.'\' ' )->fetchAll();
		echo "<p>type de la requete ".var_dump($res)."</p>";
		//echo "<p>type de la requete ".$res."</p>";
		return $res[0]['id_jeu'];
	}
    
    public function createJeu($titre, $git, $telechargement, $description)
    {
        $sql = "INSERT INTO jeux
                (titre, git, telechargement,description) VALUES (?, ?, ?, ?);";
        $req = $this->connection->prepare($sql);
        $status = $req->execute(array($titre, $git, $telechargement, $description));
        return $status;
    }
}
