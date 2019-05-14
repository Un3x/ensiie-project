<?php
namespace Eleve;
class EleveRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * EleveRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "Eleve"')->fetchAll(\PDO::FETCH_OBJ);
        $eleves = [];
        foreach ($rows as $row) {
            $eleve = new Eleve();
            $eleve
                ->setIdEleve($row->id_eleve)
                ->setNom($row->nom)
                ->setPrenom($row->prenom)
                ->setGrade($row->grade)
                ->setMdp($row->mdp)
                ->setStat($row->stat)
                ->setMail($row->mail);

            $eleves[] = $eleve;
        }

        return $eleves;
    }

    public function fetchInit()
    {
        $rows = $this->connection->query('SELECT * FROM "Eleve"')->fetchAll(\PDO::FETCH_OBJ);
        $eleves = [];
        foreach ($rows as $row) {
            $eleve = new Eleve();
            $eleve
                ->setNom($row->nom)
                ->setPrenom($row->prenom)
                ->setGrade($row->grade)
                ->setMdp($row->mdp)
                ->setStat($row->stat)
                ->setMail($row->mail);

            $eleves[] = $eleve;
        }

        return $eleves;
    }

    public function fetchEleveByMail($mail)
    {
        $rows = $this->connection->query('SELECT * FROM "Eleve" WHERE mail ='.$this->connection->quote($mail))->fetchAll(\PDO::FETCH_OBJ);
        if ($rows == null) {
            return null;
        } 
        foreach ($rows as $row) {
            $eleve = new Eleve();
            $eleve
                ->setIdEleve($row->id_eleve)
                ->setNom($row->nom)
                ->setPrenom($row->prenom)
                ->setGrade($row->grade)
                ->setMdp($row->mdp)
                ->setStat($row->stat)
                ->setMail($row->mail);
        }
        return $eleve;
    }

    public function fetchEleveById($id_eleve)
    {
        $rows = $this->connection->query('SELECT * FROM "Eleve" WHERE id_eleve ='.$this->connection->quote($id_eleve))->fetchAll(\PDO::FETCH_OBJ);
        if ($rows == null) {
            return null;
        } 
        foreach ($rows as $row) {
            $eleve = new Eleve();
            $eleve
                ->setIdEleve($row->id_eleve)
                ->setNom($row->nom)
                ->setPrenom($row->prenom)
                ->setGrade($row->grade)
                ->setMdp($row->mdp)
                ->setStat($row->stat)
                ->setMail($row->mail);
        }
        return $eleve;
    }

public function updateEleveMdp($id, $mdp)
{
    return $this->connection->query('UPDATE "Eleve" SET mdp ='.$this->connection->quote($mdp).'WHERE id_eleve ='.$this->connection->quote($id).'');
}

public function participation2($id_forum) {
    $rows = $this->connection->query('SELECT * FROM "Eleve" NATURAL JOIN "Participant" WHERE id_forum ='.$this->connection->quote($id_forum))->fetchAll(\PDO::FETCH_OBJ);
    $eleves = [];
    if ($rows == null) {
        return null;
    } 
    foreach ($rows as $row) {
        $eleve = new Eleve();
        $eleve
            ->setIdEleve($row->id_eleve)
            ->setNom($row->nom)
            ->setPrenom($row->prenom)
            ->setMail($row->mail);

            $eleves[] = $eleve;
    }
    return $eleves;
}
}
