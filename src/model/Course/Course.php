<?php
namespace Course;

class Course
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     * Name of the city
     */
    private $departure;

    /**
     * @var string
     * Name of the city
     */
    private $arrival;

    /**
     * @var int
     * id of the carrier
     */
    private $carrier



    /**
     * @var DateTime
     */
    //private $departureDateTime;

    /**
     * @var int ???? ou autres
     */
    //private $travelDuration



    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeparture()
    {
        return $this->departure;
    }

    /**
     * @param string $departure
     * @return Course
     */
    public function setDeparture($departure)
    {
        $this->departure = $departure;
        return $this;
    }

    /**
     * @return string
     */
    public function getArrival()
    {
        return $this->arrival;
    }

    /**
     * @param string $arrival
     * @return Course
     */
    public function setArrival($arrival)
    {
        $this->arrival = $arrival;
        return $this;
    }

    /**
     * @return int
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * @param int $carrier
     * @return Course
     */
    public function setCarrier($carrier)
    {
        $this->carrier = $carrier;
        return $this;
    }




}
