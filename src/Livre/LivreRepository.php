<?php
namespace Livre;

class LivreRepository
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
        $rows = $this->connection->query('SELECT * FROM "Livre"')->fetchAll(\PDO::FETCH_OBJ);
        $livres = [];
        foreach ($rows as $row) {
            $livre = new Livre();
            $livre->setId($row->id_livre);
            $livre->setTitre($row->titre);
            $livre->setAuteur($row->auteur); //TODO ALED
            $livre->setPublication(new \DateTimeImmutable($row->publication));
            $livre->setImage($row->couverture);
            $livre->setEdition($row->editeur);
            $livre->setEmprunteur($row->emprunteur);
            $livre->setDateEmprunt(new \DateTimeImmutable($row->date_emprunt));

            $livres[] = $livre;
        }

        return $livres;
    }

    public function fetchId($id_livre)
    {
        $rows = $this->connection->query("SELECT * FROM \"Livre\" WHERE id_livre='$id_livre';")->fetchAll(\PDO::FETCH_OBJ);
        foreach ($rows as $row) {
            $livre = new Livre();
            $livre->setId($row->id_livre);
            $livre->setTitre($row->titre);
            $livre->setAuteur($row->auteur); //TODO ALED
            $livre->setPublication(new \DateTimeImmutable($row->publication));
            $livre->setImage($row->couverture);
            $livre->setEdition($row->editeur);
            $livre->setEmprunteur($row->emprunteur);
            $livre->setDateEmprunt(new \DateTimeImmutable($row->date_emprunt));
        }

        return $livre;
    }

    public function fetchByUser($id_user) {//retourne les livres empruntés par $id_user
        $rows = $this->connection->query("SELECT * FROM \"Livre\" WHERE emprunteur='$id_user';")->fetchAll(\PDO::FETCH_OBJ);
        $livres = [];
        foreach ($rows as $row) {
            $livre = new Livre();
            $livre->setId($row->id_livre);
            $livre->setTitre($row->titre);
            $livre->setAuteur($row->auteur); //TODO ALED
            $livre->setPublication(new \DateTimeImmutable($row->publication));
            $livre->setImage($row->couverture);
            $livre->setEdition($row->editeur);
            $livre->setEmprunteur($row->emprunteur);
            $livre->setDateEmprunt(new \DateTimeImmutable($row->date_emprunt));

            $livres[] = $livre;
        }

        return $livres;
    }


    public function fetchReserved($id_user) {
        $rows = $this->connection->query("SELECT * FROM \"Livre\" NATURAL JOIN \"Reservation\" WHERE \"Reservation\".id_user = '$id_user';")->fetchAll(\PDO::FETCH_OBJ);
        $livres = [];
        foreach ($rows as $row) {
            $livre = new Livre();
            $livre->setId($row->id_livre);
            $livre->setTitre($row->titre);
            $livre->setAuteur($row->auteur); //TODO ALED
            $livre->setPublication(new \DateTimeImmutable($row->publication));
            $livre->setImage($row->couverture);
            $livre->setEdition($row->editeur);
            $livre->setEmprunteur($row->emprunteur);
            $livre->setDateEmprunt(new \DateTimeImmutable($row->date_emprunt));

            $livres[] = $livre;
        }

        return $livres;
    }


    public function fetchRechercheTitre($titre) {
        $tmp='%'."$titre".'%';
        $rows = $this->connection->query("SELECT * FROM \"Livre\" WHERE titre LIKE '$tmp';")->fetchAll(\PDO::FETCH_OBJ);
        $livres = [];
        foreach ($rows as $row) {
            $livre = new Livre();
            $livre->setId($row->id_livre);
            $livre->setTitre($row->titre);
            $livre->setAuteur($row->auteur); //TODO ALED
            $livre->setPublication(new \DateTimeImmutable($row->publication));
            $livre->setImage($row->couverture);
            $livre->setEdition($row->editeur);
            $livre->setEmprunteur($row->emprunteur);
            $livre->setDateEmprunt(new \DateTimeImmutable($row->date_emprunt));

            $livres[] = $livre;
        }

        return $livres;
    }

//TODO update

    public function creeLivre($id, $titre, $auteur, $publication, $couverture, $editeur, $emprunteur, $date_emprunt) {
        $ret = new Livre();
        $ret->setId($id);
        $ret->setTitre($titre);
        $ret->setAuteur($auteur);
        $ret->setPublication(new \DateTimeImmutable($publication));
        $ret->setImage($couverture);
        $ret->setEdition($editeur);
        $ret->setEmprunteur($emprunteur);
        $ret->setDateEmprunt(new \DateTimeImmutable($date_emprunt));

        return $ret;
    }

    public function updateLivre($livre) {
        $id=$livre->getId();
        $titre=$livre->getTitre();
        $auteur=$livre->getAuteur();
        $publication=date_format($livre->getPublication(), 'Y-m-d');
        $couverture=$livre->getImage();
        $editeur=$livre->getEdition();
        $emprunteur=$livre->getEmprunteur();
        $date_emprunt=date_format($livre->getDateEmprunt(), 'Y-m-d');

        $query="UPDATE \"Livre\" SET titre='$titre', auteur='$auteur', publication='$publication', couverture='$couverture', editeur='$editeur', emprunteur='$emprunteur', date_emprunt='$date_emprunt' WHERE id_livre='$id';";
        $this->connection->query("$query");

        return $query;
    }

    public function updateLivreRendu($livre) {
        $id=$livre->getId();
        $titre=$livre->getTitre();
        $auteur=$livre->getAuteur();
        $publication=date_format($livre->getPublication(), 'Y-m-d');
        $couverture=$livre->getImage();
        $editeur=$livre->getEdition();
        $emprunteur=$livre->getEmprunteur();
        $date_emprunt=date_format($livre->getDateEmprunt(), 'Y-m-d');

        $query="UPDATE \"Livre\" SET titre='$titre', auteur='$auteur', publication='$publication', couverture='$couverture', editeur='$editeur', emprunteur=NULL, date_emprunt='$date_emprunt' WHERE id_livre='$id';";
        $this->connection->query("$query");

        return $query;
    }

    public function insertLivre($livre) {
        $id=$livre->getId();
        $titre=$livre->getTitre();
        $auteur=$livre->getAuteur();
        $publication=date_format($livre->getPublication(), 'Y-m-d');
        $couverture=$livre->getImage();
        $editeur=$livre->getEdition();
        $emprunteur=$livre->getEmprunteur();
        $date_emprunt=date_format ($livre->getDateEmprunt(), 'Y-m-d');

        $query="INSERT INTO \"Livre\" VALUES ('$id', '$titre', '$auteur', '$publication', '$couverture', '$editeur', NULL, NULL);";

        $this->connection->query("$query");

        return $query;
    }
}