<?php

function csv_encode($v) {
    return '"' . $v . '"';
}

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$query = "SELECT * FROM users"; //SELECT * FROM users LEFT NATURAL JOIN pointsassos
$search = [];
foreach($_REQUEST['year'] as $y) {
    $search[] = "year='$y'";
}
if (count($search)) {
    $query .= ' WHERE ' . implode(' OR ', $search);
}
$order = $_REQUEST['order'];
if ($order) {
    $query .= ' ORDER BY ' . $order;
}

$result = mysql_query($query,$connect);

$data = [];
while ($row = mysql_fetch_assoc($result)) {
    $data[] = $row;
}
mysql_free_result($result);

if ($_REQUEST['export']) {
    header('Content-type:application/vnd.ms-excel');
    header('Content-Disposition:inline;filename=export.csv');
    
    $res = "lastname,firstname,bde,pseudo\r\n";
    foreach($data as $row) {
        $res .= csv_encode($row['lastname']) . ',';
        $res .= csv_encode($row['firstname']) . ',';
        $res .= $row['bde'] . ',';
        $res .= csv_encode($row['pseudo']) . "\r\n";
    }

    echo $res;
}
else { 
    header('Content-type:text/javascript;charset=utf-8');

    $data = json_encode($data);
   echo $data;
}
/*
echo '<pre>';
var_dump($data);
echo '</pre>';
*/


//var_dump($query);