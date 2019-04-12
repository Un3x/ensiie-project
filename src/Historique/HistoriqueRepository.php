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

            $historiques[] = $historique;
        }

        return $historiques;
    }
    //TODO update

}
