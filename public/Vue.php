<?php 
require '../vendor/autoload.php';
require_once '../src/Eleve/Eleve.php';
require_once '../src/Eleve/EleveRepository.php';



function en_tete($connect){
    if ($connect) {
      echo "<input type=\"button\" onclick = \"verif()\" value = \"Deconnexion\"/>";
      echo "<input type=\"button\" onclick = \"window.location = './profil.php'\" value = \"Mon profil\"/>";
    }
    else {
      echo "<input type=\"button\" onclick= \"window.location = './Connexion.php'\" value = \"Se connecter\"/>";
    }
 echo "<div class=\"banniere\">
        <a id=\"mainlogo\" href=\"./index.php\"><img style=\"width:70%;height:auto;\"src=\"./logo_iimage.png\"/></a>
    </div>

    <nav class=\"navbar navbar-expand-lg navbar-light fixed-top py-3\" id=\"mainNav\">
    <div class=\"container\">
    <span class=\"navbar-toggler-icon\"></span>
      <div class=\"collapse navbar-collapse\" id=\"navbarResponsive\">
        <ul class=\"navbar-nav ml-auto my-2 my-lg-0\">
          <li class=\"nav-item\">
            <a class=\"nav-link \" href=\"./index.php\">Accueil</a>
          </li>
          <li class=\"nav-item\">
            <a class=\"nav-link \" href=\"./A_propos2.php\">À propos</a>
          </li>
          <li class=\"nav-item\">
            <a class=\"nav-link \" href=\"./page_forum.php\">Forums</a>
          </li>
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"./how-to-go-to-forum.php\">Démarches Forum</a> 
            </li>
          <li class=\"nav-item\">
            <a class=\"nav-link \" href=\"./contacts.php\">Contact</a>
          </li>
        </ul>
      </div>
    </div>
    </nav>";
}



function pied() {
  echo "<footer>
  <div class=\"pied\">
        <div style=\"text-align:center;justify-content:center;\">
            <a href=\"./contacts.php\">
                <img src=\"./mail-icon.png\" />
            </a>
            <br/>
            Contactez-nous
        </div>
    </div>
</footer>";
} 

function form_connexion() {
  if (!isset($_POST['mail'])) //On est dans la page de formulaire
  {
      echo "<form method=\"post\" action=\"Connexion.php\">
      <fieldset>
      <legend>Connexion</legend>
      <p>
      <label for=\"mail\">Mail :</label><input name=\"mail\" type=\"text\" id=\"mail\" /><br />
      <label for=\"password\">Mot de Passe :</label><input type=\"password\" name=\"password\" id=\"password\" />
      </p>
      </fieldset>
      <p><input type=\"submit\" value=\"Connexion\" /></p></form> 
      <input type=\"button\" onclick = \"window.location = './index.php'\" value = \"Retour\"/>
      </div>
      </body>
      </html>";
  }
  else{
      $dbName = getenv('DB_NAME');
      $dbUser = getenv('DB_USER');
      $dbPassword = getenv('DB_PASSWORD');
      $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
  
    if (empty($_POST['mail']) || empty($_POST['password']) ) //Oublie d'un champ
    {
        echo "<p>Une erreur s'est produite pendant votre identification.
    Vous devez remplir tous les champs</p>";
    echo "<input type=\"button\" onclick =\"window.location = './Connexion.php'\" value =\"Réessayer\" />";
    }
    else //On check le mot de passe
    {
      $eleve = new \Eleve\Eleve();
      $eleveRepository = new \Eleve\EleveRepository($connection);
      $mail = $_POST['mail'];
      $eleve = $eleveRepository->fetchEleveByMail($mail);
      if ($eleve == null) {
          echo "<p>Une erreur s'est produite 
      pendant votre identification.<br /> L'utilisateur 
          entré n'est pas correcte.</p><p>";
          echo "<input type=\"button\" onclick =\"window.location = './Connexion.php'\" value =\"Réessayer\" />";
      }
      else {
      $mdp = $eleve->getMdp();
        if ($mdp == $_POST['password']) // Acces OK !
        {
            $_SESSION['id_eleve'] = $eleve->getIdEleve();
            $_SESSION['nom'] = $eleve->getNom();
            $_SESSION['mdp'] = $mdp;
            $_SESSION['prenom'] = $eleve->getPrenom();
            $_SESSION['grade'] = $eleve->getGrade();
            $_SESSION['stat'] = $eleve->getStat();
            $_SESSION['mail'] = $eleve->getMail();
            $_SESSION['connecte'] = 'Connecte';
            echo "<p>Bienvenue ".$_SESSION['prenom'].",
            vous êtes maintenant connecté !</p>";
        }
        else // Acces pas OK !
        {
            echo "<p>Une erreur s'est produite 
        pendant votre identification.<br /> Le mot de passe
            entré n'est pas correcte.</p><p>";
            echo "<input type=\"button\" onclick =\"window.location = './Connexion.php'\" value =\"Réessayer\" />";
            
        }
    }
  }
    echo "</div></body></html>";
    echo "<input type=\"button\" onclick = \"window.location = './index.php'\" value = \"Retour\"/>";
  }
  }
  ?>

<script>
    function verif(){
      var r = confirm("Souhaitez-vous vraiment vous déconnecter ?");
      if (r == true) {
            window.location = './Deconnexion.php';
        }
    }
</script>