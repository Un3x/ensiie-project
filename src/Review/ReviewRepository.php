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

    public function updateReview($review) {
        $this->connection->query('UPDATE "Review" SET "num"=$review->getNum(), "personne"=$review->getPersonne(), "texte"=$review->getTexte(), "note"=$review->getNote() WHERE "id"=$review->getId()');
    }

    public function insertReview($review) {
        $this->connection->query('INSERT INTO "Review" VALUES ($review->getId(), $review->getNum(), $review->getPersonne(), $review->getTexte(), $review->getNote())');
    }
}
