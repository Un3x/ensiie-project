<?php

$GLOBALS['connecte'] = isset($_SESSION["user"]);
if($GLOBALS['connecte'])
{
    $a = "Client";
    $b = "Vendor";
    $c = "Admin";

    $GLOBALS['client'] = ($_SESSION["user"] instanceof  $a);
    $GLOBALS['vendeur'] = ($_SESSION["user"] instanceof  $b);
    $GLOBALS['admin'] = ($_SESSION["user"] instanceof  $c);
}


function bdd()
{
    try {
    $a = new PDO('pgsql:host=localhost', "Lucas","");
} catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
    return $a;
}
/*

*/