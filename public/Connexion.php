<?php
session_start();
require '../vendor/autoload.php';
require '../src/Eleve/Eleve.php';
require '../src/Eleve/EleveRepository.php';
require '../src/Forum/Forum.php';
require '../src/Forum/ForumRepository.php';
require '../src/Participant/Participant.php';
require '../src/Participant/ParticipantRepository.php';
include './Vue.php'; ?>

<meta charset="UTF-8" content="width=device-width, initial-scale= 1.0">
<link rel="stylesheet" href="style_howTo.css">

<html>
<head>
    <title>Connexion au site d'IImage</title>
</head>
<body>

<?php en_tete(isset($_SESSION['connecte']));
form_connexion(); ?>
</body>

</html>


