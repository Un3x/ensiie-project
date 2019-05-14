<?php
namespace Participant;
class ParticipantRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * ParticipantRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "Participant"')->fetchAll(\PDO::FETCH_OBJ);
        $participants = [];
        foreach ($rows as $row) {
            $participant = new Participant();
            $participant
                ->setIdEleve($row->id_eleve)
                ->setIdForum($row->id_forum);

            $participants[] = $participant;
        }

        return $participants;
    }

    public function fetchIdForum($id_forum)
    {
        $rows = $this->connection->query('SELECT * FROM "Participant" WHERE id_forum ='.$this->connection->quote($id_forum))->fetchAll(\PDO::FETCH_OBJ);
        $participants = [];
        foreach ($rows as $row) {
            $participant = new Participant();
            $participant
                ->setIdEleve($row->id_eleve)
                ->setIdForum($row->id_forum);

            $participants[] = $participant;
        }

        return $participants;
    }

    public function fetchIdEleve($id_eleve)
    {
        $rows = $this->connection->query('SELECT * FROM "Participant" WHERE id_eleve ='.$this->connection->quote($id_eleve))->fetchAll(\PDO::FETCH_OBJ);
        $participants = [];
        foreach ($rows as $row) {
            $participant = new Participant();
            $participant
                ->setIdEleve($row->id_eleve)
                ->setIdForum($row->id_forum);

            $participants[] = $participant;
        }

        return $participants;
    }

    public function fetchId($id_eleve, $id_forum)
    {
        $rows = $this->connection->query('SELECT * FROM "Participant" WHERE id_forum ='.$this->connection->quote($id_forum).'AND id_eleve='.$this->connection->quote($id_eleve))->fetchAll(\PDO::FETCH_OBJ);
        if ($rows == null) {
            return null;
        } 
        $participants = [];
        foreach ($rows as $row) {
            $participant = new Participant();
            $participant
                ->setIdEleve($row->id_eleve)
                ->setIdForum($row->id_forum);

            $participants[] = $participant;
        }

        return $participants;
    }

    public function queryParticipant($participant) {
        $id_eleve = $participant->getIdEleve();
        $id_forum = $participant->getIdForum();
        
        $req = 'INSERT INTO "Participant" (id_eleve, id_forum)
                VALUES (:id_eleve, :id_forum)';
        $valeurs = ['id_eleve'=>$id_eleve, 'id_forum'=>$id_forum];
        $req_prepare = $this->connection->prepare($req);
        if (!$req_prepare->execute($valeurs)) {
            print_r($req_prepare->errorInfo());
            return false;
        }
        return true;
    }

    public function deleteParticipantByIdForum($id)
    {
        return $this->connection->query('DELETE FROM "Participant" WHERE id_forum ='.$this->connection->quote($id));
    }


}
