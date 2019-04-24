<?php
namespace Course

class CourseManager
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

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT id, departure, arrival, carrier FROM "course"')->fetchAll(\PDO::FETCH_OBJ);
        $courses = [];
        foreach ($rows as $row) {
            $course = new Course();
            $course
                ->setId($row->id)
                ->setDeparture($row->departure)
                ->setArrival($row->arrival)
                ->setCarrier($row->carrier);
            $courses[] = $course;
        }

        return $courses;
    }

}