<?php 
session_start();

require '../vendor/autoload.php';
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$_SESSION['verif_pseudo'] = 0;
$_SESSION['verif_mdp'] = 0;
$_SESSION['verif_mail'] = 0;

if (isset($_POST['mdp'])) {
    if (isset($_POST['mdp2'])) {
    if ($_POST['mdp'] != $_POST['mdp2']) $_SESSION['verif_mdp']=1;
    }
    else $verif_mdp=2;
}

if (isset($_POST['pseudo'])) {
    $requete=$connection->query('SELECT pseudo FROM membres');
    while ($donnees = $requete->fetch()) {
        if ($donnees['pseudo']==$_POST['pseudo']) $_SESSION['verif_pseudo']=1;
    }
}

if (isset($_POST['mail'])) {
    $requete=$connection->query('SELECT mail FROM membres');
    while ($donnees = $requete->fetch()) {
        if ($donnees['mail']==$_POST['mail']) $_SESSION['verif_mail']=1;
    }
}

if (isset($_POST['mdp']) && $_POST['mdp']!=NULL && $_SESSION['verif_mdp']==0) {
    $req=$connection->prepare('UPDATE membres SET mdp=:mdp WHERE pseudo=:pseudo;');
    $req->execute(array(
        'mdp' => $_POST['mdp'],
        'pseudo' => $_SESSION['pseudo']
    ));
}

if (isset($_POST['mail']) && $_POST['mail']!=NULL && $_SESSION['verif_mail']==0) {
    $req=$connection->prepare('UPDATE membres SET mail=:mail WHERE pseudo=:pseudo;');
    $req->execute(array(
        'mail' => $_POST['mail'],
        'pseudo' => $_SESSION['pseudo']
    ));
}

if (isset($_POST['pseudo']) && $_POST['pseudo']!=NULL && $_SESSION['verif_pseudo']==0) {
    $req=$connection->prepare('UPDATE membres SET pseudo=:newPseudo WHERE pseudo=:pseudo;');
    $req->execute(array(
        'newPseudo' => $_POST['pseudo'],
        'pseudo' => $_SESSION['pseudo']
    ));
    $_SESSION['pseudo']=$_POST['pseudo'];
}

if (isset($_POST['delete']) && $_POST['delete']=='y') {
    $requete=$connection->prepare('DELETE FROM membres WHERE pseudo=:pseudo;');
    $requete2=$connection->prepare('DELETE FROM reponses WHERE pseudo=:pseudo;');
    $requete->execute(array('pseudo' => $_SESSION['pseudo']));
    $requete2->execute(array('pseudo' => $_SESSION['pseudo']));
    $_SESSION['pseudo']=NULL;
    $_SESSION['statut']=NULL;
    $_SESSION['authent']=0;
    header("Location: accueil.php");
}
else header("Location: profil.php");
?>