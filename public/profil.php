<?php session_start(); 
require '../vendor/autoload.php';
require_once '../src/Eleve/Eleve.php';
require_once '../src/Eleve/EleveRepository.php';
require_once '../src/Participant/Participant.php';
require_once '../src/Participant/ParticipantRepository.php';
require_once '../src/Forum/Forum.php';
require_once '../src/Forum/ForumRepository.php';

echo "<meta charset=\"UTF-8\" content=\"width=device-width, initial-scale=1.0\">
        <link rel=\"stylesheet\" href=\"./profil_pres.css\">";
    include './Vue.php';
?>


<html>
    <header>
    <title>Votre profil</title>
    </header>

    <body>
        <?php en_tete(isset($_SESSION['connecte'])); 
                $nom = $_SESSION['nom'];
                $prenom = $_SESSION['prenom'];
                $mail = $_SESSION['mail'];
                ?>
                <h1>Mon profil</h1>
                <div class="donnees-user">
                    <table class="panel-donnees">
                        <tr><th>Nom :  <td><?php echo $nom ?></td></th></tr>
                        <tr><th>Prénom :  <td><?php echo $prenom ?></td></th></tr>
                        <tr><th>Mail :  <td><?php echo $mail ?></td></th></tr>
                    </table>
                </div>
                <?php
    if (!isset($_POST['mail'])) {
        echo "<form method = \"post\" action = \"./profil.php\">
        <label for=\"mail\">Mail :</label>
        <input type=\"text\" id=\"mail\" name=\"mail\" required minlength=\"1\"><br/><br/>
        <label for=\"mdp\">Mot de passe :</label>
        <input type=\"password\" id=\"mdp\" name=\"mdp\" required minlength=\"1\"><br/><br/>
        <label for=\"new_mdp\">Nouveau mot de passe :</label>
        <input type=\"password\" id=\"new_mdp\" name=\"new_mdp\" required minlength=\"1\"><br/><br/>
        <label for=\"new_mdp_confirm\">Confirmation du nouveau mot de passe :</label>
        <input type=\"password\" id=\"new_mdp_confirm\" name=\"new_mdp_confirm\" required minlength=\"1\"><br/><br/>
            <button type=\"submit\" autofocus>Changer</button>
        </form>
";
    }
    else {
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

    if (empty($_POST['mail']) || empty($_POST['mdp']) || empty($_POST['new_mdp']) || empty($_POST['new_mdp_confirm'])) {
        echo "<p>Veuillez remplir tous les critères.</p>";
        echo $_POST['mail'];
        echo $_POST['mdp'];
        echo $_POST['new_mdp'];
        echo $_POST['new_mdp_confirm'];
    }
    else {
        $eleveRepository = new \Eleve\EleveRepository($connection);
        $eleve = new \Eleve\Eleve();
        $mail = $_POST['mail'];
        $id_eleve = $_SESSION['id_eleve'];
        $mdp = $_POST['mdp'];
        $new_mdp = $_POST['new_mdp'];
        $new_mdp_confirm = $_POST['new_mdp_confirm'];
        $eleve->setMail($mail);
        $eleve->setIdEleve($id_eleve);
        $eleve->setNom($_SESSION['nom']);
        $eleve->setPrenom($_SESSION['prenom']);
        $eleve->setGrade($_SESSION['grade']);
        $eleve->setMdp($new_mdp);
        $eleve->setStat($_SESSION['stat']);
        if ($mail != $_SESSION['mail']) {
            echo "Adresse mail incorrect. Veuillez recommencer.</br>";
            echo "<input type=\"button\" value=\"Réessayer\" onclick=\"window.location='profil.php'\"/>";
        }
        else {
            if ($mdp != $_SESSION['mdp']) {
                echo "Mot de passe incorrect. Veuillez recommencer.</br>";
                echo "<input type=\"button\" value=\"Réessayer\" onclick=\"window.location='profil.php'\"/>";
            }
            else {
                if ($new_mdp != $new_mdp_confirm) {
                    echo "Mauvaise saisie du nouveau mot de passe. Veuillez recommencer.</br>";
                    echo "<input type=\"button\" value=\"Réessayer\" onclick=\"window.location='profil.php'\"/>";
                }
                else {
                    if($eleveRepository->updateEleveMdp($id_eleve, $new_mdp)) {
                        echo "Votre mot de passe a bien été modifié.</br>";
                        echo "<input type=\"button\" value=\"Retour\" onclick=\"window.location='index.php'\"/>";
                    }
                    else {
                        echo "Une erreur est survenue, veuillez recommencer.</br>";
                        echo "<input type=\"button\" value=\"Réessayer\" onclick=\"window.location='profil.php'\"/>";
                }
            }
            }
        }
    }
}
?>

<script> function afficher_cache_block(id)
{
    var e = document.getElementById(id);
    e.style.display = 'block';
} </script>

<input type="button" onclick="afficher_cache_block('mon_block')" value ="Voir mes participations"/>
<br />

<div id="mon_block" style="display: none">

        <?php 
        $dbName = getenv('DB_NAME');
        $dbUser = getenv('DB_USER');
        $dbPassword = getenv('DB_PASSWORD');
        $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
        $forumRepository2 = new \Forum\ForumRepository($connection);
      $forumsp = $forumRepository2->participation($_SESSION['id_eleve']);?>
<div class="tab_forum">
            <table class="tab_forum">
                <caption>Mes participations</caption>
                <thead>
                        <tr><th>Id</th><th>Nom</th><th>Ville</th><th>Date</th></tr>
                </thead>
                <?php       if ($forumsp != null) { ?>
                <tbody>
                <?php foreach($forumsp as $forump) :?>
	               <tr>
                        <td><?php echo $forump->getIdForum(); ?></td>
                        <td><?php echo $forump->getNom(); ?></td>
                        <td><?php echo $forump->getVille(); ?></td>
                        <td><?php echo $forump->getDate();?></td>
                   </tr>
                   <?php endforeach; ?>
                </tbody>
            </table>
        </div>
      <?php } ?>
</div>
</body>
</html>

