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





?>

<script>   
  var curr_onglet = '';

  function change_onglet(name)
  {
    //alert("ok"); 
    if(name == curr_onglet) { 
        // on ferme l'onglet si on clique dessus alors qu'il est déjà ouvert
        //document.getElementById('onglet_'+name).className = 'onglet_0 onglet';
        document.getElementById('contenu_onglet_'+name).style.display = 'none';
        document.getElementById('onglet_reservation').style.display = 'block';
        document.getElementById('onglet_emprunt').style.display = 'block';
        document.getElementById('onglet_info').style.display = 'block';
        document.getElementById('onglet_mdp').style.display = 'block';
        curr_onglet = '';
    }
    else {  
        // on cache tous les onglets
        document.getElementById('onglet_reservation').style.display = 'none';
        document.getElementById('onglet_emprunt').style.display = 'none';
        document.getElementById('onglet_info').style.display = 'none';
        document.getElementById('onglet_mdp').style.display = 'none';
      
        // on ouvre l'onglet cliqué et son contenu
        document.getElementById('onglet_'+name).style.display = 'block';
        document.getElementById('contenu_onglet_'+name).style.display = 'block';

        curr_onglet = name;
    }    
  }        
</script>

<html>
<head>
<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="formulaire.css">
    <link rel="stylesheet" href="espace_perso.css">

</head>
<div class="top"> <!--ajout d'un haut de page si l'utilisateur est admin ou si il est connecté-->
    <?php
        if ($user_connected) {
            echo "<TABLE >
        <TR>
        <TD class=\"bande1\" align=\"left\" WIDTH=\"100%\">Vous êtes connecté en tant que $nom \"$pseudo\" $prenom</TD>
        <TD style=\"border:none; height:30px\" align=\"right\"><form action=\"deconnection.php\"><input class=\"bande2\" type=\"submit\" value=\"Deconnexion\"></form></TD>
        </TR>
        </TABLE>";

            //"<p style=\"white-space: no-wrap\">Vous êtes connecté en tant que $nom \"$pseudo\" $prenom<div style=\"white-space: no-wrap\">Deconection</div> </p>";

        }
        else {
            echo "<TABLE >
        <TR>
        <TD class=\"bande1\" align=\"left\" WIDTH=\"100%\"></TD>
        <TD style=\"border:none; height:30px\" align=\"right\"><form action=\"connexion.php\"><input class=\"bande2\" type=\"submit\" value=\"Connexion\"></form></TD>
        </TR>
        </TABLE>";
        }    
    ?>

</div>
     <body>
        <header>
            <img src="./titre.png"/>
        </header>
    <nav>
        <a href="index.php" class="rubrique">Accueil    </a>
        <a href="bibliotheque.php" class="rubrique">|   Bibliothèque    </a>
        <?php if ($user_connected): ?>
            <a href="espace_perso.php" class="rubrique">|   Espace perso    </a>
            <a href="review.php" class="rubrique">|   Review    </a>
            <?php endif; ?>
        <?php if ($user_connected && $admin): ?>
            <a href="liste_emprunts.php" class="rubrique">|   Liste   </a>
            <a href="ajout_livre.php" class="rubrique">|   Ajout livre   </a>
            <a href="rendu.php" class="rubrique">|   Retour   </a>
            <a href="emprunt.php" class="rubrique">|   Emprunt   </a>
        <?php endif; ?>
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
                
                <span class="res onglet" id="onglet_info" onclick="javascript:change_onglet('info');">Modifier mes informations</span> <!-- onclick="javascript:change_onglet('');" -->
                <div class="contenu" id="contenu_onglet_info">
                    <form id="form_editer" action="editer.php" method="POST">
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
                        <input class="formulaire" id="valider" type="submit" name="Envoyer">
                    </form>
                </div>

                <div class="res onglet" id="onglet_mdp" onclick="javascript:change_onglet('mdp');">Changer mon mot de passe</div> <!-- onclick="javascript:change_onglet('');" -->
                <div class="contenu" id="contenu_onglet_mdp">
                    <form id="form_editer_mdp" action="editer.php" method="POST">
                        Nouveau mot de passe :<br>
                        <input class="formulaire" id="4" type="password" name="mdp" required><br>
                        Confirmation du nouveau mot de passe :<br>
                        <input class="formulaire" id="5" type="password" name="cmdp" oninput="check(this)" required><br>

                        <input class="formulaire" id="valider" type="submit" name="Envoyer">
                    </form>
                </div>
            </div>
            
        
        </div>
        <?php endif; ?>
            </p>
    </section>
</body>



<script>
        function check(input) {
            if (input.value != document.getElementById('4').value) {
                input.setCustomValidity('Les deux mots de passe doivent être identiques.');
            } else {
                input.setCustomValidity('');
            }
        }
</script>
</html>   