<?php
function informations($id){
    ?>

<?php
$bdd = new PDO('mysql: host=localhost ; dbname=aperofoot;charset=utf8', 'root', '');
$requete =  $bdd->query('SELECT * FROM user WHERE n_user="'.$id.'"');
$resultat = $requete->fetch();




?>
    <div class="membre_formulaire">

        <span class="membre_info">Nom :</span>

        <span class="info"><?php echo $resultat['nom'];?></span>

    </div>

    <div class="membre_formulaire">

        <span class="membre_info">Prénom :</span>

        <span class="info"><?php echo $resultat['prenom'];?></span>

    </div>

    <div class="membre_formulaire">

        <span class="membre_info">Adresse de messagerie :</span>

        <span class="info"><?php echo $resultat['email'];?></span>

    </div>

    <div class="membre_formulaire">

        <span class="membre_info">Mot de Passe :</span>

        <span class="info"><?php echo $resultat['password'];?></span>

    </div>



<?php
}
?>