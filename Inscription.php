<?php
session_start();
require '../vendor/autoload.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();

if(isset($_POST['valider'])){
    $req = $connection->query("SELECT COUNT(*) as nb FROM Person " );
    $donnees = $req->fetch();
    $name=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $age=$_POST['age'];
    $id=$donnees['nb'];
    $network=$_POST['network'];
    $sexe=$_POST['sexe'];
    $req=$connection->prepare('INSERT INTO Person(nom,prenom,age,id_personne,network) VALUES(:nom,:prenom,:age,:id_personne,:network)');
    $req->execute(array(
        'nom'=>$name,
        'prenom'=>$prenom,
        'age'=>$age,
        'id_personne'=>$id,
        'network'=>$network
    ));
    $req=$connection->prepare('INSERT INTO Sexe(id,genre) VALUES(:id,:genre)');
    $req->execute(array(
        'id'=>$id,
        'genre'=>$sexe
    ));
    if(!empty($name) AND !empty($prenom) AND !empty($age) AND !empty($network)){
        $requser=$connection->prepare("SELECT * FROM membres WHERE id_personne=?");
        $requser->execute(array($id));
        $userexist=$requser->rowCount();
        if($userexist == 1){
            $userinfo=$requser->fetch();
            $_SESSION['id_personne']=$userinfo['id_personne'];
            header("Location:cible2.php?id=".$_SESSION['id_personne']);
        }
        else {
            $erreur = "Erreur";
        }
    }
    else {
        $erreur="Tous les champs doivent être remplis";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FRIIENDS</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="css/clean-blog.min.css" rel="stylesheet">

</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="pagedebut.php">FRIIENDS</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Liste_membres.php">Inscrits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">A propos</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Page Header -->
<header class="masthead" style="background-image: url('img/home-bg.png')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1>FRIIENDS</h1>
                    <span class="subheading">Trouvez celle ou celui qui vous ressemble</span>
                </div>
            </div>
        </div>
    </div>
</header>

<div align="center">
<h5>Remplissez ce formulaire et nous nous chargeons du reste.</h5>
<form name="formulaire" method="post" action="">
    <fieldset>
        <legend>Coordonnées</legend>
        <i class="fas fa-user"></i>
        <input type="text" name="nom" placeholder="Nom" required/><br/>
        <input type="text" name="prenom" placeholder="Prénom" required/><br/>
        <i class="fas fa-birthday-cake"></i>
        <input type="int" name="age" placeholder="Age" required/><br/>
        <i class="fas fa-venus-mars"></i>
        <label for="sexe"> Sexe </label>
        H<input type="radio" name="sexe" value="homme"/>
        F<input type="radio" name="sexe" value="femme"/>
        <br/><br/>
        <input type="text" name="network" placeholder="Réseau social"/><br/>
    </fieldset>
    <input type="submit" name="valider" value="Valider"/>
</form>
</div>
<div align="center">
    <h5>
        <?php
        if(isset($erreur)){
            echo $erreur;
        }
        ?>
    </h5>
</div>
</body>
</html>

