<?php
require '../src/User/projetControl.php';
entete("gestion des inscrits");
?>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="projet.css">
</head>
<body>
<?php
$dbName     = getenv('DB_NAME');
$dbUser     = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$bdd = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
$reponse = $bdd->query('SELECT * FROM inscrit');
$status = $_SESSION['status'];
?>

<table>
    <tr>
        <td>Nom</td>
        <td>Prenom</td>
        <td>Pseudo</td>
        <td>Suppression</td>
    </tr>
<?php
    while( $ligne = $reponse->fetch())
    {
        echo "  <tr>";
        echo    "   <td>$ligne[nom]</td>
                    <td>$ligne[prenom]</td>
                    <td>$ligne[pseudo]</td>";
    
        echo '      <td>
                        <form method = "post" action = "supprimerUtilisateur.php">
                            <input type = "hidden" name = "pseudoS" value = ' .
                            $ligne["pseudo"] . '>
                            <input type = "submit" value = "Supprimer">
                        </form>
                    </td>';
        
   
    }

        echo "  </tr>";
?>

</table>
</body>
<?php
navigation($status);
pied();
?>