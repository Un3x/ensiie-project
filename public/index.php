<?php
session_start();
if (!isset($_SESSION['authent'])) {
    $_SESSION['authent'] = 0;
}

if (!isset($_SESSION['statut'])) {
    $_SESSION['statut'] = 0;
}

require '../vendor/autoload.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll(); 

$catRepository = new \User\CategorieRepository($connection);
$cats = $catRepository->fetchAll();

$phoRepository=new \User\PhotoRepository($connection);
$ProdRepository=new \User\ProduitRepository($connection);
$MessRepository= new \User\MessageRepository($connection);
$mess=$MessRepository->fetchUnvalid();

require 'connexion.php';


require("header.php");
?>

<section>
    <?php
        if ($_SESSION['authent'] == 1) {
            echo "<p class=\"accueil\">Coucou "; 
            echo $_SESSION['pseudo'];
            echo ", comment vas-tu ? <br/> Regarde un peu les nouvelles annonces &#128516;</p>";
        }

        if ($_SESSION['statut']== 1){
            $prods=sizeof($ProdRepository->getProdNonValid());
            $us=sizeof($userRepository->fetchAllUnvalid());
            $taillemes=sizeof($mess);
            echo "Vous êtes administrateur :<br/>
            Il y a <strong>".$prods."</strong> annonce(s) à traiter<br/>
            Il y a <strong>".$us."</strong> profil(s) à traiter<br/>
            Il y a <strong>".$taillemes."</strong> message(s) en attente<br/>";
        }

        if (isset($_SESSION['authent'])) {
            if (isset($_POST['uname'], $_POST['psw'])) {
                $peusdo = htmlspecialchars($_POST['uname']);
                $password = htmlspecialchars($_POST['psw']);
                $c=0;
                foreach ($users as $utilisateur) {
                    if ($utilisateur->getId() == $peusdo && $utilisateur->getMdp() == $password && $utilisateur->getValid()==1) {
                        $c=$c+1;
                    }

                    if ($utilisateur->getMail() == $peusdo && $utilisateur->getMdp() == $password && $utilisateur->getValid()==1) {
                        $c=$c+1;
                    }

                }

                if ($c==0){
                    echo "<span class=\"red\">Identifiant et/ou mot de passe incorrect(s)</span><br/>";
                }
        
            }
        }

    ?>

    <h2 class="sous_titre">Dernières annonces ajoutées sur TTT</h2>
    <?php 
        $prods=array_reverse($ProdRepository->fetchAll());
        $max=5;
        $c=0;
        foreach ($prods as $prod){
            if ($c<$max){
                $ProdRepository->afficheProd($prod);
                if ($prod->getValide()==1){
                    $c=$c+1;
                }
            }
        }

        if ($c==0){
            echo "<h4>Aucune annonce postée</h4>";
        }

        if ($_SESSION['authent'] == 1) {
            echo "<h2 class=\"sous_titre\">Tes dernières annonces sur TTT</h2>"; 
            $prods=array_reverse($ProdRepository->getProdofUser($_SESSION['pseudo']));
            $max=5;
            $c=0;
            foreach ($prods as $prod){
                if ($c<$max){
                    $ProdRepository->afficheProd($prod);
                    if ($prod->getValide()==1){
                        $c=$c+1;
                    }
                }
            }

            if ($c==0){
                echo "<h4>Tu n'as posté aucune annonce ! <a href=\"ajoutProd.php\">Qu'attends-tu ?</a> &#x1F448</h4>";
            }
        }

        if ($_SESSION['authent'] == 0){
            echo "<a href=\"sinscrire.php\"><h2 class=\"sous_titre\">Inscrivez-vous pour pouvoir poster votre annonce !</h2></a>";
        }
        ?>
</section>

<?php
require("aside.php");
require("footer.php");
?>


