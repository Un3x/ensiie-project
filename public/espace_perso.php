<?php
require '../vendor/autoload.php';

include "utils.php";


session_start();

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


$userRepository = new \User\UserRepository($connection);
$livreRepository = new \Livre\LivreRepository($connection);
$reservationRepository = new \Reservation\ReservationRepository($connection);
$users = $userRepository->fetchAll();
$user_connected=isset($_SESSION["id_user"]);

$prenom = '';
$nom = '';
$pseudo = '';
$admin = false;
if ($user_connected) {//on récupère les info sur l'utilisateur courant (si il est identifié)
//!\\ si vous le copiez vous devez avoir la ligne $userRepository = new \User\UserRepository($connection); plus haut
    $id_user=$_SESSION["id_user"];
    $user=$userRepository->fetchId($id_user);
    $admin=$user->getAdmin();
    $nom=$user->getNom();
    $prenom=$user->getPrenom();
    $pseudo=$user->getPseudo();
}


//rediriger si l'utilisateur n'est pas connecté
if (!isset($_SESSION["id_user"])) {
    header("Location: connexion.php");
}
$curr_user=$userRepository->fetchId($_SESSION["id_user"]);


$user_connected=isset($_SESSION["id_user"]);

$admin = false;
if ($user_connected) {//on récupère les info sur l'utilisateur courrant (si il est identifié)
//!\\ si vous le copiez vous devez avoir la ligne $userRepository = new \User\UserRepository($connection); plus haut et la ligne $admin = false;
    $id_user=$_SESSION["id_user"];
    $user=$userRepository->fetchId($id_user);
    $admin=$user->getAdmin();
    $nom=$user->getNom();
    $prenom=$user->getPrenom();
    $pseudo=$user->getPseudo();
}

//gestion de la demande d'annulation d'une réservation
if (isset($_POST['id_rendre'])) {
    $tmpres=$reservationRepository->creeReservation($_POST['id_rendre'], $_SESSION['id_user']);
    $reservationRepository->deleteReservation($tmpres);
}

//on récupère la liste des réservations
//on récupere la liste des livres empruntés par l'utilisateur
if ($user_connected) {
    $reservations = $reservationRepository->fetchByUser($_SESSION["id_user"]);
    $empruntés = $livreRepository->fetchByUser($_SESSION["id_user"]);
}
else {
    $reservations = [];
    $empruntés = [];
}

$curr_user=$userRepository->fetchId($_SESSION["id_user"]);

$ok_pseudo= 1;
$ok_nom= 1;
$ok_mdp= 1;

if (isset($_POST['nom'])&&isset($_POST['prenom'])&&isset($_POST['pseudo'])&&isset($_POST['info'])) {
    
    if (!verifPseudo($_POST['pseudo']) && !($_POST['pseudo']==$curr_user->getPseudo())) {
        $ok_pseudo=0;
    }
    if (!verifNomPrenom($_POST['nom'], $_POST['prenom']) && !($_POST['nom']==$curr_user->getNom() && $_POST['prenom']==$curr_user->getPrenom())) {
        $ok_nom=0;        
    }
    if ($ok_pseudo && $ok_nom) {
        $tmp = $userRepository->creeUser_editer_information($_SESSION["id_user"], $_POST['nom'], $_POST['prenom'], $_POST['pseudo'], $_POST['ddn'], $_POST['email'], $curr_user->getAdmin());
        $userRepository->updateUser_editer_information($tmp);

        header("Location: index.php");
    }
} 

if (isset($_POST['mdp']) && isset($_POST['cmdp'])&&isset($_POST['form_mdp']) ) {
    if ($_POST['mdp'] == $_POST['cmdp']) {
        $userRepository->updateUser_editer_password($_SESSION["id_user"], $_POST['mdp']);
        header("Location: index.php");
    }
    else {
        $ok_mdp = 0;
    }    
}


?>


<html>
<head>
<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/formulaire_large.css">
    <link rel="stylesheet" href="./css/espace_perso.css">
    <script type="text/javascript" src="./js/script_espace_perso.js"></script>

</head>
<div class="top"> <!--ajout d'un haut de page si l'utilisateur est admin ou si il est connecté-->
    <?php affiche_bandeau_connexion($user_connected, $nom, $prenom, $pseudo, $admin) ?> 
    <!-- dans utils.php -->
</div>
     <body>
        <header>
            <img src="../images/sciience.png"/>
        </header>
    <nav>
        <?php affiche_nav($user_connected, $admin) ?> <!-- dans utils.php -->
    </nav>
    <section>
        <div class="grand-titre">Bienvenue sur la page perso de <?php echo"$pseudo"; ?></div>
        <?php if (!($user_connected)) : ?>
        <div class="non connecté">
            Vous n'êtes pas connectés, veuillez vous connecter<a href="connexion.php">ICI</a>pour accéder aux informations</div>
         <?php endif; ?>
        <?php if ($user_connected) : ?>

        <div class="content">
            <div class="onglets">
                <div class="res onglet" id="onglet_reservation" onclick="change_onglet('reservation');">Mes réservations</div>  <!-- onclick="javascript:change_onglet('');" -->
                <div class="contenu" id="contenu_onglet_reservation">
                    <?php if ($reservations == []): ?>
                    <p>Vous n'avez pas de réservations</p>
                    <?php endif; ?>
                    <?php if ($reservations != []): ?>
                    <table>
                        <thead>
                            <th>Couverture</th>
                            <th>Titre</th>
                            <th>Annuler la réservation</th>
                        </thead>
                    <?php foreach ($reservations as $reservation) : ?>
                        <?php $livre=$livreRepository->fetchId($reservation->getIdLivre()); ?>
                        <tr>
                            <td class="couv"><img height="160" width="100" src=<?php echo $livre->getImage(); ?>></td>
                            <td><?php echo $livre->getTitre(); ?></td>
                            <td><form action="espace_perso.php" method="POST"><input style="display:none" type="text" name="id_rendre" value=<?php $tmp=$reservation->getIdLivre(); echo "$tmp"; ?>><input type="submit"  class="butcan" value="Annuler"></form></td>
                        </tr>
                    <?php endforeach; ?>
                    </table>
                    <p></p>
                    <?php endif; ?>
                </div> 

                <div class="res onglet" id="onglet_emprunt" onclick="change_onglet('emprunt');">Mes emprunts</div> <!-- onclick="javascript:change_onglet('')" -->
                <div class="contenu" id="contenu_onglet_emprunt">                
                    <?php if ($empruntés == []): ?>
                        <p>Vous n'avez pas d'emprunts en cours</p>
                    <?php endif; ?>
                    <?php if ($empruntés != []): ?>
                    <table>
                        <thead>
                            <th>Couverture</th>
                            <th>Titre</th>
                        </thead>
                        <?php foreach ($empruntés as $emprunté) : ?>
                            <tr>
                                <td class="couv"><img height="160" width="100" src=<?php echo $emprunté->getImage(); ?>></td>
                                <td><?php echo $emprunté->getTitre(); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <p></p>
                    <?php endif; ?>
                </div>
                
                <span class="res onglet" id="onglet_info" onclick="change_onglet('info');">Modifier mes informations</span> <!-- onclick="javascript:change_onglet('');" -->
                <div class="contenu" id="contenu_onglet_info">
                    <?php 
						if($ok_pseudo == 0 || $ok_nom == 0) {
							echo '<span class="invalid_submit">Modification invalide !</span></br>';
							if($ok_nom == 0) 
								echo '<span class="invalid_submit">Le couple Prénom/Nom apparaît déjà dans nos bases de données. Avez-vous un autre compte ?</span>';
							else if ($ok_pseudo == 0) 
								echo '<span class="invalid_submit">Ce pseudo existe déjà !</span>';										
						}			
					?>
                    <form class="form" id="form_editer" action="espace_perso.php" method="POST">
                        <!-- champs caché pour savoir si on vient de info ou mdp -->
						<input type="hidden" name="info" value="42"/> 
                        Nom :<br>
                        <input class="formulaire" id="1" type="text" name="nom" value=<?php echo $curr_user->getNom() ?> required pattern="[ a-zA-Z0-9']*[a-zA-Z0-9]" maxlength="50"/><br>
                        Prenom :<br>
                        <input class="formulaire" id="2" type="text" name="prenom" value=<?php echo $curr_user->getPrenom() ?> required pattern="[ a-zA-Z0-9']*[a-zA-Z0-9]" maxlength="50" /><br>
                        Pseudo :<br>
                        <input class="formulaire" id="3" type="text" name="pseudo" value=<?php echo $curr_user->getPseudo() ?> required pattern="[ a-zA-Z0-9']*[a-zA-Z0-9]" maxlength="50"><br>
                        Date de naissance :<br>
                        <input class="formulaire" id="6" type="date" name="ddn" value=<?php echo $curr_user->getDdn() ?> required /><br>
                        Email :<br>
                        <input class="formulaire" id="7" type="text" name="email" value=<?php echo $curr_user->getMail() ?> required pattern="[a-zA-Z0-9._-]*@[a-zA-Z0-9-]*.[a-zA-Z]*" maxlength="50"/><br>
                        <input class="formulaire" id="valider_info" type="submit" value="Envoyer">
                    </form>
                </div>

                <div class="res onglet" id="onglet_mdp" onclick="change_onglet('mdp');">Changer mon mot de passe</div> <!-- onclick="javascript:change_onglet('');" -->
                <div class="contenu" id="contenu_onglet_mdp">
                    <?php 
                        if ($ok_mdp == 0)
                            echo '<span class="invalid_submit">Vos mots de passe doivent être identiques !</span>';
                    ?>
                    <form class="form" id="form_editer_mdp" action="espace_perso.php" method="POST">
                        <!-- champs caché pour savoir si on vient de info ou mdp -->
						<input type="hidden" name="form_mdp" value="42"/> 
                        Nouveau mot de passe :<br>
                        <input class="formulaire" id="4" type="password" name="mdp" required><br>
                        Confirmation du nouveau mot de passe :<br>
                        <input class="formulaire" id="5" type="password" name="cmdp" oninput="check_mdp(this)" required><br>

                        <input class="formulaire" id="valider_mdp" type="submit" value="Envoyer">
                    </form>
                </div>
            </div>
            
        
        </div>
        <?php endif; ?>
        
    </section>
    <?php affiche_footer()?>
</body>

<script>
    // si l'un des 2 est false, c'est que l'utilisateur était sur modification des infos et 
    //s'est trompé donc on le remet sur modification
    if ( <?php echo $ok_nom ?> == 0 || <?php echo $ok_pseudo ?> == 0 ) {
        change_onglet('info');
    }
    else if (<?php echo $ok_mdp ?> == 0) {
        // si il s'est trompé sur le mdp, on le remet sur la modification de mot de passe
        change_onglet('mdp');
    }		
</script>



</html>   