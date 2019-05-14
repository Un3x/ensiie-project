<div id="id01" class="modal">
  
  <form class="modal-content animate" action=<?php echo $_SESSION['adresse'];?> method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>

    <div class="container">
      <label for="pseudo"><b>Pseudo</b></label>
      <input type="text" placeholder="Entrez votre pseudo" name="pseudo" class="log" required>

      <label for="mdp"><b>Mot de passe</b></label>
      <input type="password" placeholder="Entrez votre mot de passe" name="mdp" class="log" required>
      <button type="submit" class="connexion">Connexion</button><br/>
      <a href="inscription.php" class="connexion"><div class="connexion">Inscription</div></a>
      
    </div>

  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

<?php
require '../vendor/autoload.php';
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : NULL;
$mdp = isset($_POST['mdp']) ? $_POST['mdp'] : NULL;

$_SESSION['fail_connect']=0;

if ($_SESSION['authent']==0 && $pseudo!=NULL) {
$_SESSION['fail_connect']=1;
$requete=$connection->query('SELECT pseudo, mdp, statut FROM membres ');
while ($donnees = $requete->fetch()) {
  if ($donnees['pseudo']==$pseudo && $donnees['mdp']==$mdp) {
    $_SESSION['authent']=1;
    $_SESSION['statut']=$donnees['statut'];
    $_SESSION['pseudo']=$pseudo;
    $_SESSION['fail_connect']=0;
  }
}
}

unset($_POST['pseudo']);
unset($_POST['mdp']);

?>