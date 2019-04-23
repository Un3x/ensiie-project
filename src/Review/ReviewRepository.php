<?php
namespace Review;
class ReviewRepository
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
        $rows = $this->connection->query('SELECT * FROM "Review"')->fetchAll(\PDO::FETCH_OBJ);
        $reviews = [];
        foreach ($rows as $row) {
            $review = new Review();
            $review
                ->setId($row->id)
                ->setNum($row->num)
                ->setPersonne($row->personne)
                ->setTexte($row->texte)
                ->setNote($row->note);

            $reviews[] = $review;
        }

        return $reviews;
    }

//TODO update

    public function creeReview($id, $num, $personne, $texte, $note) {
        $ret = new Review();
        $ret->setId($id);
        $ret->setNum($num);
        $ret->setPersonne($personne);
        $ret->setTexte($texte);
        $ret->setNote($note);

        return $ret;
    }


    public function updateReview($review) {
        $id=$review->getId();
        $num=$review->getNum();
        $personne=$review->getPersonne();
        $texte=$review->getTexte();
        $note=$review->getNote();


        $query="UPDATE \"Review\" SET num='$num', personne='$personne', texte='$texte', note='$note' WHERE id='$id';";

        $this->connection->query("$query");

        return $query;
    }



    public function insertReview($review) {
        $id=$review->getId();
        $num=$review->getNum();
        $personne=$review->getPersonne();
        $texte=$review->getTexte();
        $note=$review->getNote();

        $query="INSERT INTO \"Review\" VALUES ('$id', '$num', '$personne', '$texte', '$note');";

        $this->connection->query("$query");

        return $query;
    }

    public function deleteReview($review) {
        $id=$review->getId();

        $query="DELETE FROM \"Review\" WHERE id='$id';";

        $this->connection->query("$query");

        return $query;
    }
}
