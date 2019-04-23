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
            $livre
                ->setId($row->id)
                ->setTitre($row->titre)
                ->setAuteurs($row->auteur) //TODO ALED
                ->setPublication(new \DateTimeImmutable($row->publication))
                ->setImage($row->couverture)
                ->setEdition($row->edition);

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
        $ret->setEditeur($editeur);
        $ret->setEmprunteur($emprunteur);
        $ret->setDateEmprunt(new \DateTimeImmutable($date_emprunt));

        return $ret;
    }

    public function updateLivre($livre) {
        $id=getId();
        $titre=getTitre();
        $auteur=getAuteur();
        $publication=getPublication();
        $couverture=getImage();
        $editeur=getEditeur();
        $emprunteur=getEmprunteur();
        $date_emprunt=getDateEmprunt();

        $query="UPDATE \"Livre\" SET titre='$titre', auteur='$auteur', publication='$publication', couverture='$couverture', editeur='$editeur', emprunteur='$emprunteur', date_emprunt='$date_emprunt' WHERE id_livre='$id';";
        $this->connection->query("$query");

        return $query;
    }

    public function insertLivre($livre) {
        $id=getId();
        $titre=getTitre();
        $auteur=getAuteur();
        $publication=getPublication();
        $couverture=getImage();
        $editeur=getEditeur();
        $emprunteur=getEmprunteur();
        $date_emprunt=getDateEmprunt();

        $query="INSERT INTO \"Livre\" VALUES ('$id', '$titre', '$auteur', $publication, '$couverture', '$editeur', '$emprunteur', $date_emprunt);";

        $this->connection->query("$query");

        return $query;
    }
}
