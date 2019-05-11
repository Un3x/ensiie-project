<?php
namespace CommentCustomer;

class CommentCustomerManager
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
     * @param id of the customer
     * fetch all comment on the customer
     */
    public function fetchComment($customer)
    {
        $statement = $this->connection->prepare("SELECT * FROM commentCustomer where customer = :customer");
        $rows = $statement->execute(array("customer" => $customer))->fetchAll();
        $courses = [];
        foreach ($rows as $row) {
            $comment = new CommentCustomer();
            $comment
                ->setId($row->id_comment_customer)
                ->setCustomer($row->customer)
                ->setContent($row->content);
            $courses[] = $course;
        }

        return $courses;
    }


    /**
     * create a comment
     */
    public function createComment($customer,$content);
    {
        $statement = $this->connection->prepare("INSERT INTO commentCustomer (customer,content) VALUES (:customer,:content)");
        $statement->execute(array("customer" => $customer,
                                  "content" => $content));
    }

}