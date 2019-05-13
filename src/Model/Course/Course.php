<?php

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
    private $carrier;

    /**
     * @var int
     * id of the client
     */
    private $client;


    /**
     * @var DateTime
     */
    private $departureDateTime;

    /**
     * @var int
     */
    private $state;

    /**
     * @var float
     */
    private $price;



    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Course
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

    /**
     * @return int
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param int $client
     * @return Course
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDepartureDateTime()
    {
        return $this->departureDateTime;
    }

    /**
     * @param DateTime $departureDateTime
     * @return Course
     */
    public function setDepartureDateTime($departureDateTime)
    {
        $this->departureDateTime = new DateTime($departureDateTime);
        return $this;
    }

    /**
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param int $state
     * @return Course
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return Course
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }
}


function distance($lat1, $lon1, $lat2, $lon2)
{
    //rayon de la terre
    $r = 6366;
    $lat1 = deg2rad($lat1);
    $lat2 = deg2rad($lat2);
    $lon1 = deg2rad($lon1);
    $lon2 = deg2rad($lon2);

    //calcul précis
    $dp= 2 * asin(sqrt(pow (sin(($lat1-$lat2)/2) , 2) + cos($lat1)*cos($lat2)* pow( sin(($lon1-$lon2)/2) , 2)));

    //sortie en km
    $d = $dp * $r;

    return round($d/1.616, 2);
}