<?php
use Admin\AdminRepository;
use Compte\CompteRepository;
require('../src/Compte/CompteRepository.php');
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection;
try {
    $connection = new \PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
function Film()
{
    global $connection;
   $film = new \Film\FilmRepository($connection);
    return $film;
}
function Admin()
{
    global $connection;
    $admin = new AdminRepository($connection);
    return $admin;
}
function Compteo()
{
    global $connection;
    $compte=new CompteRepository($connection);
    return $compte->getCompte("redwan","redwan12");
}
