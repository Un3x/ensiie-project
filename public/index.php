<?php
require '../vendor/autoload.php';
require '../src/Eleve/Eleve.php';
require '../src/Eleve/EleveRepository.php';
require '../src/Forum/Forum.php';
require '../src/Forum/ForumRepository.php';
require '../src/Participant/Participant.php';
require '../src/Participant/ParticipantRepository.php';

session_start();

include ('./Vue.php');



//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$eleveRepository = new \Eleve\EleveRepository($connection);
$eleves = $eleveRepository->fetchAll();
$forumRepository = new \Forum\ForumRepository($connection);
$forums = $forumRepository->fetchAll();
$participantRepository = new \Participant\ParticipantRepository($connection);
$participants = $participantRepository->fetchAll();

$connection = null;
?>

<meta charset="UTF-8" content="width=device-width, initial-scale= 1.0">
<link rel="stylesheet" href="style_howTo.css">

<html>
<head>
    <title>Site d'IImage</title>
</head>

<body>
<?php en_tete(isset($_SESSION['connecte'])); ?>
       <h1>Bienvenue sur le site d'IImage !</h1>
       <div class = "photo_groupe">
           <img src ="./photo_groupe.jpg" alt = "Photo de l'équipe d'IImage" style = "width : 50%; height: auto;" />
</div>
<br/>
</body>
</html>

<?php pied();
 ?>
