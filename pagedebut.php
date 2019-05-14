<?php
require '../vendor/autoload.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();
?>


<?php
if(isset($_POST['forminscription'])){
    if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
        $pseudo=htmlspecialchars($_POST['pseudo']);
        $mail=htmlspecialchars($_POST['mail']);
        $mail2=htmlspecialchars($_POST['mail2']);
        $mdp=sha1($_POST['mdp']);
        $mdp2=sha1($_POST['mdp2']);
        $pseudolength=strlen($pseudo);
        if($pseudolength <=255){
            if($mail==$mail2) {
                if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $reqmail=$connection->prepare("SELECT * FROM membres WHERE mail = ?");
                    $reqmail->execute(array($mail));
                    $mailexist=$reqmail->rowCount();
                    $req = $connection->query("SELECT COUNT(*) as nb FROM Person " );
                    $donnees = $req->fetch();
                    $id=$donnees['nb'];
                    if($mailexist==0){
                        if ($mdp == $mdp2) {
                            $insertmbr = $connection->prepare("INSERT INTO membres(id_personne,pseudo,mail,motdepasse) VALUES (?,?,?,?)");
                            $insertmbr->execute(array($id,$pseudo,$mail,$mdp));
                            $erreur="Votre compte a bien été créé";
                        }
                        else {
                            $erreur = "Vos mots de passe ne correspondent pas";
                        }
                    }
                    else {
                        $erreur="Adresse déjà utilisée";
                    }
                }
                else{
                    $erreur="Votre adresse mail n'est pas valide";
                }
            }
            else{
                $erreur="Vos adresses emails ne correspondent pas";
            }
        }
        else{
            $erreur="Votre pseudo ne doit dépasser 255 caractères";
        }
    }
    else {
        $erreur="Tous les champs doivent être remplis";
    }
}
?>

<html lang="en">

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
            <h2>Inscription</h2>
            <br/><br/>
            <form method="POST" action="">
                <table>
                    <tr>
                        <td align="right">
                            <label for="pseudo">Pseudo:</label>
                        </td>
                        <td>
                            <input type="text" placeholder = "Votre pseudo" name="pseudo" value="<?php if(isset($pseudo)) {echo $pseudo;} ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label for="mail">Mail:</label>
                        </td>
                        <td>
                            <input type="mail" placeholder = "Votre mail" id="mail" name="mail" value="<?php if(isset($mail)) {echo $mail;} ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label for="mail2">Confirmation du mail:</label>
                        </td>
                        <td>
                            <input type="mail" placeholder = "Votre mail" id="mail2" name="mail2" value="<?php if(isset($mail2)) {echo $mail2;} ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label for="mdp">Mot de passe:</label>
                        </td>
                        <td>
                            <input type="password" placeholder = "Votre mot de passe" id="mdp" name="mdp"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label for="mdp2">Confirmation du mot de passe:</label>
                        </td>
                        <td>
                            <input type="password" placeholder = "Votre mot de passe" id="mdp2" name="mdp2"/>
                        </td>
                    </tr>
                </table>
                <br/>
                <input type="submit" name="forminscription" value="Je m'inscris" />
            </form>
            <?php
            if(isset($erreur)){
                echo $erreur;
            }
            ?>
            <br>
            <br>
            <?php
            if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])
                AND isset($_POST['forminscription']) AND $pseudolength <=255 AND $mail==$mail2 AND $mailexist==0
                AND $mdp == $mdp2){
                echo '<a href="inscription.php">Continuer</a>';
            }
            ?>
        </div>

</body>
</html>
