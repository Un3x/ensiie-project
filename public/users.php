<?php
require '../vendor/autoload.php';

function csv_encode($v) {
    return '"' . $v . '"';
}

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$query = "SELECT * FROM users";
$search = [];
foreach($_REQUEST['year'] as $y) {
    $search[] = "year='$y'";
}
if (count($search)) {
    $query .= ' WHERE ' . implode(' OR ', $search);
}
$order = $_REQUEST['order'];
if ($order && $order != "notation") {
    $query .= ' ORDER BY ' . $order;
}

$user_rows = $connection->query($query)->fetchAll(\PDO::FETCH_ASSOC);

$resultat = [];
foreach($user_rows as $user) {
    $id = $user['id_user'];
    $ligne = [
        'id_user' => $id,
        'firstname' => $user['firstname'],
        'lastname' => $user['lastname'],
        'pseudo' => $user['pseudo'],
        'asso' => []
    ];
    if (isset($_REQUEST['asso'])) {
        foreach($_REQUEST['asso'] as $asso) {
            $q = "SELECT * FROM pointsassos WHERE pointsassos.id_user = $id AND pointsassos.id_asso = " . $connection->quote($asso);
            $rows = $connection->query($q)->fetchAll(\PDO::FETCH_ASSOC);
            if ($rows) {
                $ligne['asso'][$rows[0]['id_asso']] = $rows[0]['notation'];
            }
        }
    }
    $resultat[] = $ligne;
}

if (@$_REQUEST['export']) {
    header('Content-type:application/vnd.ms-excel');
    header('Content-Disposition:inline;filename=export.csv');
    
    $res = "lastname,firstname,pseudo";
    if (isset($_REQUEST['asso'])) {
        foreach($_REQUEST['asso'] as $asso_id) {
            $q = "SELECT name FROM associations WHERE id_asso = $asso_id";
            $rows = $connection->query($q)->fetchAll(\PDO::FETCH_ASSOC);
            $res .= "," . $rows[0]['name'];
        }
    }
    $res .= "\r\n";
    foreach($resultat as $row) {
        $res .= csv_encode($row['lastname']) . ',';
        $res .= csv_encode($row['firstname']) . ',';
        $res .= csv_encode($row['pseudo']);
        if (isset($_REQUEST['asso'])) {
            foreach($_REQUEST['asso'] as $asso_id) {
                $res .= ",";
                if (isset($row['asso'][$asso_id])) {
                    $res .= $row['asso'][$asso_id];
                };
            }
        }
        $res .= "\r\n";
    }

    echo $res;
}
else { 
    header('Content-type:text/javascript;charset=utf-8');

    $data = json_encode($resultat);
   echo $data;
}
/*
echo '<pre>';
var_dump($data);
echo '</pre>';
*/


//var_dump($query);