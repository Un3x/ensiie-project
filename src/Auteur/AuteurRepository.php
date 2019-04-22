<?php
namespace Auteur;
class AuteurRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * ReviewRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "Auteur"')->fetchAll(\PDO::FETCH_OBJ);
        $auteurs = [];
        foreach ($rows as $row) {
            $auteur = new Auteur();
            $auteur
                ->setIdLivre($row->id_livre)
                ->setAuteur($row->auteur);
            $auteurs[] = $auteur;
        }

        return $auteur;
    }

//TODO update

    /*public function updateAuteur($auteur) {
        $this->connection->query('UPDATE "Auteur" SET "id_livre"=$auteur->getIdLivre(), "auteur"=$auteur->getAuteur(), WHERE "id_livre"=$auteur->getIdLivre()');
    } pas nécessaire*/

    public function insertAuteur($auteur) {
        $this->connection->query('INSERT INTO "Auteur" VALUES ($auteur->getIdLivre(), $auteur->getAuteur())');
    }
}
