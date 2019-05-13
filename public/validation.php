<?php
session_start();
if (!isset($_SESSION['authent'])) {
    $_SESSION['authent'] = 0;
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
$taillemess=sizeof($mess);

require 'connexion.php';

if ($_SESSION['authent'] == 0 || $_SESSION['statut'] != 1) {
    echo "<meta http-equiv=\"Refresh\" content=\"2;url=index.php\">";
    exit();
}


require("header.php");
?>

<section>
<script>
function show(etat,id){
    document.getElementById(id).style.display=etat;
}
</script>

<?php

if(isset($_POST['id'],$_POST['type'],$_POST['delete'])){
    if($_POST['delete']==1){
        if ($_POST['type']=='produit'){
            $connection->query("UPDATE produits SET valide='2' WHERE id_produit='".$_POST['id']."';");
        }
        else{
            $connection->query("UPDATE ".$_POST['type']." SET valid='2' WHERE id='".$_POST['id']."';");
        }
        echo $_POST['type']." ".$_POST['id']." bien supprimé<br/>";
        $_POST['type']=null;
        $_POST['id']=null;
        $_POST['delete']=null;
    }

    else if($_POST['delete']==0){
        if ($_POST['type']=='produit'){
            $connection->query("UPDATE produits SET valide='1' WHERE id_produit='".$_POST['id']."';");
        }
        else{
            $connection->query("UPDATE ".$_POST['type']." SET valid='1' WHERE id='".$_POST['id']."';");
        }
        echo $_POST['type']." ".$_POST['id']." bien validé<br/>";
        $_POST['type']=null;
        $_POST['id']=null;
        $_POST['delete']=null;

    }
}
?>
<a href="checkmessage.php"><h2 class="sous_titre"><?php echo $taillemess;?> message(s) en attente</h2></a>
<h2 class="sous_titre">Les annonces pas encore validées :</h2>
<?php 
    $prods=array_reverse($ProdRepository->getProdNonValid());
    if ($prods!=[]){
        foreach ($prods as $prod){
            $ProdRepository->afficheProdEvenUnvalid($prod);
            echo "

            <form method=\"post\" action=\"validation.php\">
                <input type=\"hidden\" name=\"id\" value=\"".$prod->getIdProd()."\">
                <input type=\"hidden\" name=\"type\" value=\"produit\">
                <input type=\"hidden\" name=\"delete\" value=\"0\" >
                    <div class=\"flexbox_boutton\">
                        <div class=\"bouton\">
                            <input type=\"submit\" value=\"&#10004; Valider\" name=\"validation\">
                        </div>
                        <div class=\"bouton\">
                            <input type=\"reset\" onclick=\"show('block','".$prod->getIdProd()."')\" value=\"&#128465; Supprimer\" name=\"supprimer\">
                        </div>
                    </div>
            </form>
            <div id=\"".$prod->getIdProd()."\">
            Êtes-vous sur de vouloir supprimer ce produit ?
                <form method=\"post\" action=\"validation.php\">
                    <input type=\"hidden\" name=\"delete\" value=\"1\" >
                    <input type=\"hidden\" name=\"id\" value=\"".$prod->getIdProd()."\">
                    <input type=\"hidden\" name=\"type\" value=\"produit\">
                    <div class=\"flexbox_boutton\">
                        <div class=\"bouton\">
                            <input type=\"submit\" value=\"Oui\" name=\"Oui\">
                        </div>
                        <div class=\"bouton\">
                        <input type=\"reset\" onclick=\"show('none','".$prod->getIdProd()."')\" value=\"Non\" name=\"Non\">
                        </div>
                    </div>
                </form>
            </div>
            <script>show('none','".$prod->getIdProd()."');</script>"
        ;
        }
    }
    else {
        echo "<h4>Aucune annonce à valider ! Good Job !</h4>";
    }
?>

<h2 class="sous_titre">Les utilisateurs pas encore validés :</h2>
<?php 
    $users=array_reverse($userRepository->fetchAllUnvalid());
    if ($users!=[]){
        foreach ($users as $user){
            $userRepository->afficheUserEvenUnvalid($user);
            echo "

            <form method=\"post\" action=\"validation.php\">
                <input type=\"hidden\" name=\"id\" value=\"".$user->getId()."\">
                <input type=\"hidden\" name=\"type\" value=\"utilisateur\">
                <input type=\"hidden\" name=\"delete\" value=\"0\" >
                    <div class=\"flexbox_boutton\">
                        <div class=\"bouton\">
                            <input type=\"submit\" value=\"&#10004; Valider\" name=\"validation\">
                        </div>
                        <div class=\"bouton\">
                            <input type=\"reset\" onclick=\"show('block','".$user->getId()."')\" value=\"&#128465; Supprimer\" name=\"supprimer\">
                        </div>
                    </div>
            </form>
            <div id=\"".$user->getId()."\">
            Êtes-vous sur de vouloir supprimer cet utilisateur ?
                <form method=\"post\" action=\"validation.php\">
                    <input type=\"hidden\" name=\"delete\" value=\"1\" >
                    <input type=\"hidden\" name=\"id\" value=\"".$user->getId()."\">
                    <input type=\"hidden\" name=\"type\" value=\"utilisateur\">
                    <div class=\"flexbox_boutton\">
                        <div class=\"bouton\">
                            <input type=\"submit\" value=\"Oui\" name=\"Oui\">
                        </div>
                        <div class=\"bouton\">
                        <input type=\"reset\" onclick=\"show('none','".$user->getId()."')\" value=\"Non\" name=\"Non\">
                        </div>
                    </div>
                </form>
            </div>
            <script>show('none','".$user->getId()."');</script>"
        ;
        }
    }
    else {
        echo "<h4>Aucun utilisateur à valider ! Good Job !</h4>";
    }
?>

<h2 class="sous_titre">Les produits supprimés par les administrateurs :</h2>
<?php 
    $prods=array_reverse($ProdRepository->fetchAllDeleteByAdmin());
    if ($prods!=[]){
        foreach ($prods as $prod){
            $ProdRepository->afficheProdEvenUnvalid($prod);
        }
    }
    else {
        echo "<h4>Aucun produit supprimé par les administrateurs !</h4>";
    }
?>

<h2 class="sous_titre">Les utilisateurs supprimés par les administrateurs :</h2>
<?php 
    $users=array_reverse($userRepository->fetchAllDeleteByAdmin());
    if ($users!=[]){
        foreach ($users as $user){
            $userRepository->afficheUserEvenUnvalid($user);
        }
    }
    else {
        echo "<h4>Aucun utilisateur supprimé par les administrateurs !</h4>";
    }
?>

<h2 class="sous_titre">Les produits supprimés par leurs prorpriétaires :</h2>
<?php 
    $prods=array_reverse($ProdRepository->fetchAllDeleteByUser());
    if ($prods!=[]){
        foreach ($prods as $prod){
            $ProdRepository->afficheProdEvenUnvalid($prod);
        }
    }
    else {
        echo "<h4>Aucun produit supprimé par les administrateurs !</h4>";
    }
?>
</section>

<?php
require("aside.php");
require("footer.php");
?>