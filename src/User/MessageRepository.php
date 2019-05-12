<?php

namespace User;
class MessageRepository
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
        $rows = $this->connection->query('SELECT * FROM "message"')->fetchAll(\PDO::FETCH_OBJ);
        $cats = [];
        foreach ($rows as $row) {
            $cat = new Message();
            $cat
                ->setId($row->id_mess)
                ->setTitre($row->titre)
                ->setContenu($row->contenu)
                ->setMail($row->mail)
                ->setIdAdmin($row->id_admin)
                ->setValid($row->valid);

            $cats[] = $cat;
        }

        return $cats;
    }

    public function fetchUnvalid()

    {
        $rows = $this->connection->query('SELECT * FROM "message" WHERE valid=0')->fetchAll(\PDO::FETCH_OBJ);
        $cats = [];
        foreach ($rows as $row) {
            $cat = new Message();
            $cat
                ->setId($row->id_mess)
                ->setTitre($row->titre)
                ->setContenu($row->contenu)
                ->setMail($row->mail)
                ->setIdAdmin($row->id_admin)
                ->setValid($row->valid);

            $cats[] = $cat;
        }

        return $cats;
    }

    public function fetchValid()

    {
        $rows = $this->connection->query('SELECT * FROM "message" WHERE valid=1')->fetchAll(\PDO::FETCH_OBJ);
        $cats = [];
        foreach ($rows as $row) {
            $cat = new Message();
            $cat
                ->setId($row->id_mess)
                ->setTitre($row->titre)
                ->setContenu($row->contenu)
                ->setMail($row->mail)
                ->setIdAdmin($row->id_admin)
                ->setValid($row->valid);

            $cats[] = $cat;
        }

        return $cats;
    }

    public function fetchDeleted()

    {
        $rows = $this->connection->query('SELECT * FROM "message" WHERE valid=2')->fetchAll(\PDO::FETCH_OBJ);
        $cats = [];
        foreach ($rows as $row) {
            $cat = new Message();
            $cat
                ->setId($row->id_mess)
                ->setTitre($row->titre)
                ->setContenu($row->contenu)
                ->setMail($row->mail)
                ->setIdAdmin($row->id_admin)
                ->setValid($row->valid);

            $cats[] = $cat;
        }

        return $cats;
    }

    public function getMessage($id)

    {
        $rows = $this->connection->query("SELECT * FROM \"message\" WHERE id_mess='".$id."';")->fetchAll(\PDO::FETCH_OBJ);
        $cats = [];
        foreach ($rows as $row) {
            $cat = new Message();
            $cat
                ->setId($row->id_mess)
                ->setTitre($row->titre)
                ->setContenu($row->contenu)
                ->setMail($row->mail)
                ->setIdAdmin($row->id_admin)
                ->setValid($row->valid);

            $cats[] = $cat;
        }

        return $cats;
    }


    public function getMax()
{
    $rows=$this->connection->query('SELECT MAX(id_mess) FROM "message";')->fetchAll(\PDO::FETCH_OBJ);
    $c=$rows[0]->max;
    return $c;
}
}