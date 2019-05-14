<?php session_start(); ?>

<meta charset="UTF-8" content="width=device-width, initial-scale= 1.0">
<link href="./propose_forum_pres.css" rel="stylesheet">

<?php

require '../vendor/autoload.php';
require_once '../src/Forum/Forum.php';
require_once '../src/Forum/ForumRepository.php';
include './Vue.php';
include './Verification.php'; ?>

<html>
<head> 
<title>Ajout d'un forum</title>
</head>
</html>

<?php en_tete(isset($_SESSION['connecte']));  

if (verif_admin()) {
    if (!isset($_POST['nom'])) {
    echo "<div class=\"form-prop-forum\">
     <form method=\"post\" action=\"./propose_forum.php\">
        <label for=\"nom\">Nom :</label>
        <input type=\"text\" id=\"nom\" name=\"nom\" required minlength=\"1\"><br/><br/>
        <label for=\"ville\">Ville :</label>
        <input type=\"text\" id=\"ville\" name=\"ville\" required minlength=\"1\"><br/><br/>
        <label for=\"date\">Date :</label>
        <input type=\"date\" id=\"date\" name=\"date\"><br/><br/>
        <button type=\"submit\" autofocus>Proposer</button></br></br>
        <input type=\"button\" value=\"Retour\" onclick=\"window.location='./page_forum.php'\"/>
    </form></div>";
    }
    else {
        $dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

    if (empty($_POST['nom']) || empty($_POST['ville']) || (empty($_POST['date']))) {
        echo "<p>Une erreur s\'est produite pendant votre identification. 
        Vous devez remplir tous les champs.<p>";
    }
    else {
        $forum = new \Forum\Forum();
        $forumRepository = new \Forum\ForumRepository($connection);
        $nom = $_POST['nom'];
        $ville = $_POST['ville'];
        $date = $_POST['date'];
        $forum->setNom($nom);
        $forum->setVille($ville);
        $forum->setDate($date);
        if ($forumRepository->queryForum($forum)) {
            echo "Votre forum a bien été ajouté.</br>";
            echo "<input type=\"button\" value=\"Retour\" onclick=\"window.location='page_forum.php'\"/>";
            echo "<input type=\"button\" value=\"Ajouter un autre forum\" onclick=\"window.location='propose_forum.php'\"/>";
        }
        else {
            echo "Problème : une erreur est survenue, le forum n'a pas pu être rajouté. Veuillez réessayer.";
        }
    }
}
}
?>
