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





    /**
     * @return all available course 
     */
    public function fetchAllCourses()
    {
        $rows = $this->connection->query("SELECT * FROM course where state = 0")->fetchAll();
        $courses = [];
        foreach ($rows as $row) {
            $course = new Course();
            $course
                ->setId($row->id_course)
                ->setDeparture($row->departure)
                ->setArrival($row->arrival)
                ->setCarrier($row->carrier)
                ->setDepartureDateTime($row->departureDateTime)
                ->setState($row->state);
            $courses[] = $course;
        }

        return $courses;
    }

    /**
     * @param string $departure $arrival DateTIme $departureDateTime
     */
    public function fetchCourses($departure,$arrival,$departureDateTime)
    {
        $statement = $this->connection->prepare("SELECT * FROM course where departure = :departure AND arrival = :arrival AND departureDateTime >= :departureDateTime AND state = 0");
        $rows = $statement->execute(array("departure" => $departure,
                                          "arrival" => $arrival,
                                          "departureDateTime" => $departureDateTime))->fetchAll();
        $courses = [];
        foreach ($rows as $row) {
            $course = new Course();
            $course
                ->setId($row->id_course)
                ->setDeparture($row->departure)
                ->setArrival($row->arrival)
                ->setCarrier($row->carrier)
                ->setDepartureDateTime($row->departureDateTime)
                ->setState($row->state);
            $courses[] = $course;
        }

        return $courses;
    }

    /**
     * work only if the course exist in the db
     * change the state and the id of the client
     */
    public function changeCourse($id_course,$state,$client)
    {
        $statement = $this->connection->prepare("UPDATE course SET state = :state AND client = :client WHERE id_course = :id");
        $statement->execute(array("id" => $id_course,
                                  "state" => $state,
                                  "client" => $client));
        
        $statement = $this->connection->prepare("SELECT * FROM course WHERE id_course = :id");
        $rows = $statement->execute(array("id" => $id_course))->fetchAll();
        foreach($rows as $row) 
        {
            $course = new Course();
            $course
                ->setId($row->id_course)
                ->setDeparture($row->departure)
                ->setArrival($row->arrival)
                ->setCarrier($row->carrier)
                ->setDepartureDateTime($row->departureDateTime)
                ->setState($row->state);
        }

        return $course;
    }

    /**
     * get the client history
     */
    public function getCourseClient($client)
    {
        $statement = $this->connection->prepare("SELECT * FROM course where client = :client AND state = 2");
        $rows = $statement->execute(array("client" => $client))->fetchAll();
        $courses = [];
        foreach ($rows as $row) {
            $course = new Course();
            $course
                ->setId($row->id_course)
                ->setDeparture($row->departure)
                ->setArrival($row->arrival)
                ->setCarrier($row->carrier)
                ->setDepartureDateTime($row->departureDateTime)
                ->setState($row->state);
            $courses[] = $course;
        }

        return $courses;
    }

    /**
     * get the client history
     */
    public function getCourseClient($carrier)
    {
        $statement = $this->connection->prepare("SELECT * FROM course where carrier = :carrier AND state = 2");
        $rows = $statement->execute(array("carrier" => $carrier))->fetchAll();
        $courses = [];
        foreach ($rows as $row) {
            $course = new Course();
            $course
                ->setId($row->id_course)
                ->setDeparture($row->departure)
                ->setArrival($row->arrival)
                ->setCarrier($row->carrier)
                ->setDepartureDateTime($row->departureDateTime)
                ->setState($row->state);
            $courses[] = $course;
        }

        return $courses;
    }
    
    public function fetchThisCourse($departure,$arrival,$departureDateTime,$carrier)
    {
        $statement = $this->connection->prepare("SELECT * FROM course WHERE carrier = :carrier AND departure = :departure AND arrival = :arrival AND departureDateTime = :departureDateTime");
        $rows = $statement->execute(array("carrier" => $carrier,
                                          "departure" => $departure,
                                          "arrival" => $arrival,
                                          "departureDateTime" => $departureDateTime))->fetchAll();
        foreach ($rows as $row) {
            $course = new Course();
            $course
                ->setId($row->id_course)
                ->setDeparture($row->departure)
                ->setArrival($row->arrival)
                ->setCarrier($row->carrier)
                ->setDepartureDateTime($row->departureDateTime)
                ->setState($row->state);
        }

        return $courses;
    }
*/
}