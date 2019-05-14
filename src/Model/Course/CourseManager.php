<?php

require("Course.php");

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

        $statement = $this->connection->prepare("UPDATE Course SET state=3 where extract(second from CURRENT_TIMESTAMP - datetime) > (duration * 5391) AND state=2");
        $statement->execute(array());
        $rows = $statement->fetchAll();
        //print_r($statement->errorInfo());
        //print_r($rows);



    }





    /**
     * @return all available Course 
     */
    public function fetchAllCourses()
    {
        $rows = $this->connection->query("SELECT * FROM course where state = 0")->fetchAll();
        $courses = [];
        foreach ($rows as $row) {
            $course = new Course();
            $course
                ->setId($row['id'])
                ->setDeparture($row['departure'])
                ->setArrival($row['arrival'])
                ->setCarrier($row['carrier'])
                ->setDepartureDateTime($row['departureDateTime'])
                ->setState($row['state'])
                ->setPrice($row['price']);
            $courses[] = $course;
        }

        return $courses;
    }
    public function fetchAllCoursesAll()
    {
        $rows = $this->connection->query("SELECT * FROM course")->fetchAll();
        $courses = [];
        foreach ($rows as $row) {
            $course = new Course();
            $course
                ->setId($row['id'])
                ->setDeparture($row['departure'])
                ->setArrival($row['arrival'])
                ->setCarrier($row['carrier'])
                ->setClient($row['client'])
                ->setDepartureDateTime($row['datetime'])
                ->setState($row['state'])
                ->setPrice($row['price']);
            $courses[] = $course;
        }

        return $courses;
    }

    /**
     * @param string $departure $arrival
     */
    public function fetchCourses($departure,$arrival)
    {
        $statement = $this->connection->prepare("SELECT Vendor.id, Vendor.surname, Vendor.firstname, Vendor.price, cities.latitude, cities.longitude, Race.speed FROM Vendor JOIN cities ON position=cities.id JOIN Race ON idRace=Race.id where cities.name=:departure AND Vendor.occupied = FALSE");
        $statement->execute(array("departure" => $departure));
        $rows = $statement->fetchAll(); 
        
        $statement2 = $this->connection->prepare("SELECT latitude, longitude  FROM cities where name=:name");
        $statement2->execute(array("name" => $arrival));
        $city = $statement2->fetch();

        $courses = [];

        foreach ($rows as $row) {
            $distance = distance($row['latitude'], $row['longitude'], $city['latitude'], $city['longitude']);

            $course = ["carrierId" => $row['id'], "surname" => $row['surname'], "firstname" => $row['firstname'], "price" => round($row['price'] * $distance, 2), "distance" => $distance, "duration" => round($distance/$row['speed'], 2)];
            $courses[] = $course;
        }

        return $courses;
    }

    /**
     * work only if the course exist in the db
     * change the state
     */
    public function changeCourse($id_course,$state)
    {
        $statement = $this->connection->prepare("UPDATE Course SET state = :state WHERE id = :id");
        return $statement->execute(array("id" => $id_course,
                                  "state" => $state));
    }

    /**
     * get the client history
     */
    public function getCourseClient($client)
    {
        $statement = $this->connection->prepare("SELECT * FROM Course where client = :client AND state = 2");
        $statement->execute(array("client" => $client));
        $rows = $statement->fetchAll();
        $courses = [];
        foreach ($rows as $row) {
            $course = new Course();
            $course
                ->setId($row['id'])
                ->setDeparture($row['departure'])
                ->setArrival($row['arrival'])
                ->setCarrier($row['carrier'])
                ->setClient($row['client'])
                ->setDepartureDateTime($row['datetime'])
                ->setPrice($row['price'])
                ->setState($row['state']);
            $courses[] = $course;
        }

        return $courses;
    }

    /**
     * get the carrier history
     */
    public function getCourseCarrier($carrier)
    {
        $statement = $this->connection->prepare("SELECT * FROM Course where carrier = :carrier AND state = 2");
        $statement->execute(array("carrier" => $carrier));
        $rows = $statement->fetchAll();
        $courses = [];
        foreach ($rows as $row) {
            $course = new Course();
            $course
                ->setId($row['id'])
                ->setDeparture($row['departure'])
                ->setArrival($row['arrival'])
                ->setCarrier($row['carrier'])
                ->setClient($row['client'])
                ->setDepartureDateTime($row['datetime'])
                ->setPrice($row['price'])
                ->setState($row['state']);
            $courses[] = $course;
        }

        return $courses;
    }
    
    public function fetchThisCourse($departure,$arrival,$carrierId)
    {
        $statement = $this->connection->prepare("SELECT Vendor.id, Vendor.surname, Vendor.firstname, Vendor.price, cities.latitude, cities.longitude, Race.speed  FROM Vendor JOIN cities ON position=cities.id JOIN Race ON idRace=Race.id where cities.name=:departure AND Vendor.occupied = FALSE AND Vendor.id=:id");
        $statement->execute(array("departure" => $departure, "id"=>$carrierId));
        $row = $statement->fetch(); 
        
        $statement2 = $this->connection->prepare("SELECT latitude, longitude  FROM cities where name=:name");
        $statement2->execute(array("name" => $arrival));
        $city = $statement2->fetch();

        if (!$row || !$city) return [];

        $distance = distance($row['latitude'], $row['longitude'], $city['latitude'], $city['longitude']);
        $course = ["carrierId" => $row['id'], "surname" => $row['surname'], "firstname" => $row['firstname'], "price" => round($row['price'] * $distance, 2), 'departureLat' => $row['latitude'], 'departureLong' => $row['longitude'], 'arrivalLat' => $city['latitude'], 'arrivalLong' => $city['longitude'], "distance" => $distance, "duration" => round($distance/$row['speed'], 2)];

        return $course;
    }

    public function preBookCourse($departure, $arrival, $carrier, $client){
        $statement2 = $this->connection->prepare("SELECT id,latitude,longitude FROM cities where name=:name");
        $statement2->execute(array("name" => $departure));
        $departure = $statement2->fetch();
        $statement2->execute(array("name" => $arrival));
        $arrival = $statement2->fetch();
        $statement3 = $this->connection->prepare("SELECT price, Race.speed FROM Vendor JOIN Race ON idRace=Race.id where Vendor.id=:id");
        $statement3->execute(array("id" => $carrier));
        $vendor = $statement3->fetch();

        $distance = distance($departure['latitude'], $departure['longitude'], $arrival['latitude'], $arrival['longitude']);
        $statement = $this->connection->prepare("INSERT INTO Course (departure, arrival, carrier, client, datetime, state, price, distance, duration) VALUES (:departure, :arrival, :carrier, :client, :datetime, 0, :price, :distance, :duration)");
        if ($statement->execute(array("departure"=>$departure['id'], "arrival"=>$arrival['id'], "carrier"=>$carrier, "client"=>$client, 'datetime'=>date_create()->format('Y-m-d H:i:s'), 'price'=>$vendor['price'] * $distance, "distance" => $distance, "duration" => round($distance/$vendor['speed'], 2)))){
            return $this->connection->lastInsertId();
        }
        else{
            return false;
        }
    }

    public function getCourse($id)
    {
        $statement = $this->connection->prepare("SELECT Vendor.id, Vendor.surname, Vendor.firstname, Client.id, Client.surname, Client.firstname, Course.price, Departure.name, Arrival.name, Departure.latitude, Departure.longitude, Arrival.latitude, Arrival.longitude, datetime, state, distance, duration FROM Course JOIN cities AS Departure ON departure=Departure.id JOIN cities AS Arrival ON arrival=Arrival.id JOIN Vendor ON carrier=Vendor.id JOIN Client ON client=Client.id where Course.id=:id");
        $statement->execute(array("id" => $id));
        $row = $statement->fetch();

        if (!$row) return [];
        
        $course = ["carrierId" => $row[0], "carrierSurname" => $row[1], "carrierFirstname" => $row[2], "clientId" => $row[3], "clientSurname" => $row[4], "clientFirstname" => $row[5], "price" => $row[6], "departure" => $row[7], "arrival" => $row[8], "departureLat" => $row[9], "departureLong" => $row[10], "arrivalLat" => $row[11], "arrivalLong" => $row[12], "datetime" => $row[13], "state" => $row[14], "distance"=>$row[15], "duration"=>$row[16]];
        return $course;
    }

}