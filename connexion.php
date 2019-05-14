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

if(isset($_POST['formconnexion'])){
    $mailconnect=htmlspecialchars($_POST['mailconnect']);
    $mdpconnect=sha1($_POST['mdpconnect']);
    if(!empty($mailconnect) AND !empty($mdpconnect)){
        $requser=$connection->prepare("SELECT * FROM membres WHERE mail = ? AND motdepasse = ?");
        $requser->execute(array($mailconnect,$mdpconnect));
        $userexist=$requser->rowCount();
        if($userexist == 1){
            $userinfo=$requser->fetch();
            $_SESSION['id']=$userinfo['id_personne'];
            $_SESSION['pseudo']=$userinfo['pseudo'];
            $_SESSION['mail']=$userinfo['mail'];
            header("Location:profil.php?id=".$_SESSION['id']);
        }
        else {
            $erreur = "Mauvais mail ou mot de passe";
        }
    }
    else {
        $erreur="Tous les champs doivent être remplis";
    }
}

?>

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
                    <a class="nav-link" href="pagedebut.php">Inscription</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="connexion.php">Connexion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Liste_membres.php">Inscrits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">Contact</a>
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
    <h2>Connexion à FRIIENDS</h2>
    <br/><br/>
    <form method="post" action="">
        Adresse mail :<input type="email" name="mailconnect">
        Mot de passe :<input type="password" name="mdpconnect">
        <input type="submit" name="formconnexion">
    </form>
    <?php
    if(isset($erreur)){
        echo $erreur;
    }
    ?>
</div>
</body>
</html>
