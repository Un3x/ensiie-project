<?php

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$query = "SELECT * FROM associations";
/*
$result = mysql_query($query,$connect);

$data = [];
while ($row = mysql_fetch_assoc($result)) {
    $data[] = $row;
}
mysql_free_result($result);

header('Content-type:text/javascript;charset=utf-8');

$data = json_encode($data);
echo $data;
 */
/*
echo '<pre>';
var_dump($data);
echo '</pre>';
*/

//var_dump($query);

echo $connection->query($query)->fetchAll();
