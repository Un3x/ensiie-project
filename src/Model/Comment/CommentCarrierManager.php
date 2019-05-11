<?php
namespace CommentCarrier;

class CommentCarrierManager
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * CourseManager constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }


    /**
     * @param id of the carrier
     * fetch all comment on the carrier
     */
    public function fetchComment($carrier)
    {
        $statement = $this->connection->prepare("SELECT * FROM commentCarrier where carrier = :carrier");
        $rows = $statement->execute(array("carrier" => $carrier))->fetchAll();
        $courses = [];
        foreach ($rows as $row) {
            $comment = new CommentCarrier();
            $comment
                ->setId($row->id_comment_customer)
                ->setCarrier($row->carrier)
                ->setContent($row->content);
            $courses[] = $course;
        }

        return $courses;
    }


    /**
     * create a comment
     */
    public function createComment($carrier,$content);
    {
        $statement = $this->connection->prepare("INSERT INTO commentCarrier (carrier,content) VALUES (:carrier,:content)");
        $statement->execute(array("carrier" => $carrier,
                                  "content" => $content));
    }

}