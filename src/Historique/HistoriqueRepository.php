<?php
namespace Historique;
class HistoriqueRepository
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
        $rows = $this->connection->query('SELECT * FROM "Historique"')->fetchAll(\PDO::FETCH_OBJ);
        $historiques = [];
        foreach ($rows as $row) {
            $hist = new Historique();
            $hist
                ->setIdLivre($row->id_livre)
                ->setIdUser($row->id_user)
                ->setDateEmprunt(new \DateTimeImmutable($row->date_emprunt))
                ->setDateRendu(new \DateTimeImmutable($row->date_rendu))
                ->setIdReview($row->id_review)
                ->setNumReview($row->num_review);

            $historiques[] = $hist;
        }

        return $historiques;
    }


    public function fetchByUser($id_user) {
        $rows = $this->connection->query("SELECT * FROM \"Historique\" WHERE id_user='$id_user';")->fetchAll(\PDO::FETCH_OBJ);
        $historiques = [];
        foreach ($rows as $row) {
            $hist = new Historique();
            $hist
                ->setIdLivre($row->id_livre)
                ->setIdUser($row->id_user)
                ->setDateEmprunt(new \DateTimeImmutable($row->date_emprunt))
                ->setDateRendu(new \DateTimeImmutable($row->date_rendu))
                ->setIdReview($row->id_review)
                ->setNumReview($row->num_review);

            $historiques[] = $hist;
        }

        return $historiques;
    }



    public function fetchByUserAndLivre($id_user, $id_livre) {
        $rows = $this->connection->query("SELECT * FROM \"Historique\" WHERE id_user='$id_user' AND id_livre='$id_livre';")->fetchAll(\PDO::FETCH_OBJ);
        foreach ($rows as $row) {
            $hist = new Historique();
            $hist
                ->setIdLivre($row->id_livre)
                ->setIdUser($row->id_user)
                ->setDateEmprunt(new \DateTimeImmutable($row->date_emprunt))
                ->setDateRendu(new \DateTimeImmutable($row->date_rendu))
                ->setIdReview($row->id_review)
                ->setNumReview($row->num_review);
        }

        return $hist;
    }
    //TODO update

    public function creeHistorique($id_livre, $id_user, $date_emprunt, $date_rendu, $id_review, $num_review) {

        $ret = new Historique();
        $ret->setIdLivre($id_livre);
        $ret->setIdUser($id_user);
        $ret->setDateEmprunt($date_emprunt);
        $ret->setDateRendu($date_rendu);
        $ret->setIdReview($id_review);
        $ret->setNumReview($num_review);

        return $ret;
    }


    public function updateHistorique($historique) {
        $id_livre=$historique->getIdLivre();
        $id_user=$historique->getIdUser();
        $date_emprunt=$historique->getDateEmprunt();
        $date_rendu=$historique->getDateRendu();
        $id_review=$historique->getIdReview();
        $num_review=$historique->getNumReview();

        $query="UPDATE \"Historique\" SET date_emprunt='$date_emprunt', date_rendu='$date_rendu', id_review='$id_review', num_review='$num_review' WHERE id_livre='$id_livre' AND id_user='$id_user';";


        $this->connection->query("$query");

        return $query;
    }


    public function insertHistorique($historique) {
        $id_livre=$historique->getIdLivre();
        $id_user=$historique->getIdUser();
        $date_emprunt=date_format ($historique->getDateEmprunt(), 'Y-m-d');
        $date_rendu=date_format ($historique->getDateRendu(), 'Y-m-d');
        $id_review=$historique->getIdReview();
        $num_review=$historique->getNumReview();

        $query="INSERT INTO \"Historique\"(id_livre, id_user, date_emprunt, date_rendu) VALUES ('$id_livre', '$id_user', '$date_emprunt', '$date_rendu');";
        //TODO mouais


        $this->connection->query("$query");


        return $query;
    }

}
