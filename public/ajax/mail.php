<?php
require '../../vendor/autoload.php';
include('../admin/functions.php');

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
// On prolonge la session
session_start();
 
if(empty($_SESSION['recup']) || empty($_SESSION['email'])) 
{
  // Si inexistante ou nulle, on redirige vers le formulaire de login
  header('Location: forgotten.php');
  exit();
}

function sendMail($to, $subject, $message) {
    $url = 'smtps://smtp.gmail.com:465';
    $account = 'association.gestion.iie@gmail.com';
    
    $password = 'e9iXl%M1ZrY7';
    $body = "Date: " . date("r") . "\n";
    $body .= "Subject: " . $subject . "\n";
    $body .= "Content-Transfer-Encoding: 8bit\n";
    $body .= "Content-Type: text/plain;charset=utf-8\n";
    $body .= "\n";
    $body .= $message;
    $body .= "";
    file_put_contents('/tmp/temp.txt', $body);
    $command = 'curl ' . $url . ' -u "' . $account . ':' . $password . '" --mail-from ' . $account . ' --mail-rcpt "' . $to . '" --ssl --upload-file /tmp/temp.txt';
    shell_exec($command);
    @unlink('/tmp/temp.txt');
}

$to      = $_SESSION['email'];
$subject = 'changement de mot de passe';
$message = "Bonjour\nVoici votre code de récupération:\n" . $_SESSION['recup'] . "\nCeci est un message automatique, Veuillez ne pas répondre";
sendMail($to, $subject, $message);
header('Location: ../recup.php');