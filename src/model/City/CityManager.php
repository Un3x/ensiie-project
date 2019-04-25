<?php

namespace City;
class CityManager{

    private $connection;

    private $preparedQueryAutocompl;

    public function __construct(\PDO $connection){
        $this->connection = $connection;
    }
    
    public function getCityAutocompl($name, $number){
        $res = $this->connection->query("SELECT name FROM cities WHERE name ILIKE '$name%' ORDER BY population DESC FETCH FIRST $number ROWS ONLY")->fetchAll(\PDO::FETCH_OBJ);;

        $cities = [];

        foreach($res as $row){
            $cities[] = $row->name;
        }

        return $cities;
    }
}
