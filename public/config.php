<?php
/* Le fichier config.php doit contenir l\'initialisation des variables php $nomBase avec le nom de la base de données dans laquelle vous avez créé la relation tp_client et $nomuser avec votre login */

$nom_hote= "localhost" ; /*"pgsql2";*/
$nom_base = getenv('DB_NAME'); /* avant tpphp */
$nom_user = getenv('DB_USER');
$mdp=getenv('DB_PASSWORD');


$AUTHENT=0;

?>
