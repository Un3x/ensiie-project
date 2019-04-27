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

        return $auteurs;
    }


    public function fetchByLivre($id_livre) {//retourne la liste des auteurs de $id_livre
        $rows = $this->connection->query("SELECT * FROM \"Auteur\" WHERE id_livre='$id_livre';")->fetchAll(\PDO::FETCH_OBJ);
        $auteurs = [];
        foreach ($rows as $row) {
            $auteur = new Auteur();
            $auteur
                ->setIdLivre($row->id_livre)
                ->setAuteur($row->auteur);
            $auteurs[] = $auteur;
        }

        return $auteurs;
    }


    public function creeAuteur($id_livre, $id_auteur) {
        $ret = new Auteur();
        $ret->setIdLivre($id_livre);
        $ret->setAuteur($id_auteur);

        return $ret;
    }

    /*public function updateAuteur($auteur) {
        $this->connection->query('UPDATE "Auteur" SET "id_livre"=$auteur->getIdLivre(), "auteur"=$auteur->getAuteur(), WHERE "id_livre"=$auteur->getIdLivre()');
    } pas nécessaire*/

    public function insertAuteur($auteur) {
        $id_livre=$auteur->getIdLivre();
        $id_auteur=$auteur->getAuteur();

        $query="INSERT INTO \"Auteur\" VALUES ('$id_livre', '$id_auteur');";
        $this->connection->query("$query");

        return $query;
    }

    public function deleteAuteur($auteur) {
        $id_livre=$auteur->getIdLivre();
        $id_auteur=$auteur->getIdAuteur();

        $query="DELETE FROM \"Auteur\" WHERE id_livre='$id_livre' AND id_auteur='$id_auteur';";

        $this->connection->query("$query");

        return $query;
    }
}
