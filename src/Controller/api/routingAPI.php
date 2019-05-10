<?php
if(true || isset($_GET['departureLat']) && isset($_GET['departureLong']) && isset($_GET['arrivalLat']) && isset($_GET['arrivalLong'])){
    $key = "5b3ce3597851110001cf6248c6e87f2691cf4b8aad0d91e3fa3f3de1";
    
    $departureLat = $_GET['departureLat'];
    $departureLong = $_GET['departureLong'];
    $arrivalLat = $_GET['arrivalLat'];
    $arrivalLong = $_GET['arrivalLong'];

    $curl = curl_init("https://api.openrouteservice.org/v2/directions/driving-car?api_key=$key&start=$departureLong,$departureLat&end=$arrivalLong,$arrivalLat");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_COOKIESESSION, true);
    $return = curl_exec($curl);
    curl_close($curl);

    $lCoord = [];
    
    foreach (json_decode($return, true)['features']['0']['geometry']['coordinates'] as $coord){
        $lCoord[] = array_reverse($coord);
    }


    echo '{"status" : "success", "data" : '.json_encode($lCoord).'}';

}
else{
    header("HTTP/1.1 400 Bad Request");
    echo '{"status" : "fail"}';
}
