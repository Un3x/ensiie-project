<?php

session_start();

require '../vendor/autoload.php';
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

if ($_SESSION['statut']=='V') {
$already_in = 0;
$requete=$connection->query('SELECT pseudo FROM "reponses";');
while ($donnees = $requete->fetch()) {
    if ($donnees['pseudo']==$_SESSION['pseudo']) {
        $already_in = 1;
        $requete2 = $connection->prepare('UPDATE "reponses" 
        SET un=:un, deux=:deux, trois=:trois, quatre=:quatre, cinq=:cinq, six=:six, sept=:sept,
        huit=:huit, neuf=:neuf, dix=:dix WHERE pseudo=:pseudo;');
        $requete2->execute(array(
        'pseudo' => $_SESSION['pseudo'],
        'un' => $_POST['Q1'],
        'deux' => $_POST['Q2'],
        'trois' => $_POST['Q3'],
        'quatre' => $_POST['Q4'],
        'cinq' => $_POST['Q5'],
        'six' => $_POST['Q6'],
        'sept' => $_POST['Q7'],
        'huit' => $_POST['Q8'],
        'neuf' => $_POST['Q9'],
        'dix' => $_POST['Q10']
        ));
    }
}

if ($already_in==0) {
$requete3 = $connection->prepare('INSERT INTO "reponses" (pseudo,un,deux,trois,quatre,cinq,six,sept,huit,neuf,dix) 
VALUES (:pseudo,:un,:deux,:trois,:quatre,:cinq,:six,:sept,:huit,:neuf,:dix);');
$requete3->execute(array(
    'pseudo' => $_SESSION['pseudo'],
    'un' => $_POST['Q1'],
    'deux' => $_POST['Q2'],
    'trois' => $_POST['Q3'],
    'quatre' => $_POST['Q4'],
    'cinq' => $_POST['Q5'],
    'six' => $_POST['Q6'],
    'sept' => $_POST['Q7'],
    'huit' => $_POST['Q8'],
    'neuf' => $_POST['Q9'],
    'dix' => $_POST['Q10']
));
}
}

$N=0; $L=0; $H=0; $A=0; $F=0; 

if ($_POST['Q1']=='N') $N++;
if ($_POST['Q1']=='L') $L++;
if ($_POST['Q1']=='H') $H++;
if ($_POST['Q1']=='A') $A++;
if ($_POST['Q1']=='F') $F++;

if ($_POST['Q2']=='N') $N++;
if ($_POST['Q2']=='L') $L++;
if ($_POST['Q2']=='H') $H++;
if ($_POST['Q2']=='A') $A++;
if ($_POST['Q2']=='F') $F++;

if ($_POST['Q3']=='N') $N++;
if ($_POST['Q3']=='L') $L++;
if ($_POST['Q3']=='H') $H++;
if ($_POST['Q3']=='A') $A++;
if ($_POST['Q3']=='F') $F++;

if ($_POST['Q4']=='N') $N++;
if ($_POST['Q4']=='L') $L++;
if ($_POST['Q4']=='H') $H++;
if ($_POST['Q4']=='A') $A++;
if ($_POST['Q4']=='F') $F++;

if ($_POST['Q5']=='N') $N++;
if ($_POST['Q5']=='L') $L++;
if ($_POST['Q5']=='H') $H++;
if ($_POST['Q5']=='A') $A++;
if ($_POST['Q5']=='F') $F++;

if ($_POST['Q6']=='N') $N++;
if ($_POST['Q6']=='L') $L++;
if ($_POST['Q6']=='H') $H++;
if ($_POST['Q6']=='A') $A++;
if ($_POST['Q6']=='F') $F++;

if ($_POST['Q7']=='N') $N++;
if ($_POST['Q7']=='L') $L++;
if ($_POST['Q7']=='H') $H++;
if ($_POST['Q7']=='F') $F++;

if ($_POST['Q8']=='N') $N++;
if ($_POST['Q8']=='L') $L++;
if ($_POST['Q8']=='H') $H++;
if ($_POST['Q8']=='A') $A++;
if ($_POST['Q8']=='F') $F++;

if ($_POST['Q9']=='N') $N++;
if ($_POST['Q9']=='L') $L++;
if ($_POST['Q9']=='H') $H++;
if ($_POST['Q9']=='A') $A++;
if ($_POST['Q9']=='F') $F++;

if ($_POST['Q10']=='N') $N++;
if ($_POST['Q10']=='L') $L++;
if ($_POST['Q10']=='H') $H++;
if ($_POST['Q10']=='A') $A++;
if ($_POST['Q10']=='F') $F++;

$max = max($N,$H,$L,$A,$F);

if ($max==$N) header("Location: nathane.php");
if ($max==$H) header("Location: hugo.php");
if ($max==$A) header("Location: aime/aime.php");
if ($max==$L) header("Location: louis.php");
if ($max==$F) header("Location: flo.php");


?>