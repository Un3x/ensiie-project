<html>
<head>
    <meta charset="utf-8" />
    <title>LINUX</title>
</head>

<body>
<h1>Salam a si RAdouane!</h1>
<p>on COmmence :</p>
<p>retourner a la page principal</p>
<?php
if(isset($_GET['titre']))echo ' le film : '.$_GET['titre'].': a été ajouter';
else if(isset($_GET['action'])&& $_GET['action']=='afficher') echo "le film hhhh : ".$film['titre'];
else echo $_GET['id'].' :::: '.$commentaire;

    ?>
<p> Rien ?</p>
</body>

</html>