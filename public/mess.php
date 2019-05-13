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

require 'connexion.php';


if ($_SESSION['authent'] == 0 || $_SESSION['statut'] != 1) {
    echo "<meta http-equiv=\"Refresh\" content=\"2;url=index.php\">";
    exit();
}

if (!isset($_GET['id_mess'])){
    echo "<meta http-equiv=\"Refresh\" content=\"2;url=checkmessage.php\">";
    exit();
}
$_GET['id_mess']=htmlspecialchars($_GET['id_mess']);



require("header.php");
?>

<section>
<?php
    if (isset($_POST['delete'],$_POST['id'])){
        if ($_POST['delete']==0){
            $connection->query("UPDATE \"message\" SET valid=1, id_admin='".$_SESSION['pseudo']."' WHERE id_mess='".$_POST['id']."';");
            $_POST['delete']==null;
            $_POST['id']==null;
            echo "L'annonce a bien été validée<br/>";
        }

        if ($_POST['delete']==1){
            $connection->query("UPDATE \"message\" SET valid=2, id_admin='".$_SESSION['pseudo']."' WHERE id_mess='".$_POST['id']."';");
            $_POST['delete']==null;
            $_POST['id']==null;
            echo "L'annonce a bien été supprimée<br/>";
        }

    }

    $mess=$MessRepository->getMessage($_GET['id_mess']);

    if ($mess==[]){
        echo "<meta http-equiv=\"Refresh\" content=\"2;url=checkmessage.php\">";
            exit();
}

    $user=$userRepository->testmail($mess[0]->getMail());
?>
<script type="text/javascript">
function show(etat,id){
    document.getElementById(id).style.display=etat;
}
</script>
<h2 class="sous_titre"><?php echo $mess[0]->getTitre();?></h2>
<?php
if ($user==[]){
    echo "L'utilisateur n'est pas inscrit sur le site.<br/>Son adresse mail est : ".$mess[0]->getMail();
}
else{
    $userRepository->afficheUserEvenUnvalid($user[0]);
}
?>
<h3>Contenu du message : </h3><br/>
<?php
echo $mess[0]->getContenu();
?>

<?php 

if ($mess[0]->getValid()==0){
    echo "

            <form method=\"post\" action=\"mess.php\">
                <input type=\"hidden\" name=\"id\" value=\"".$mess[0]->getId()."\">
                <input type=\"hidden\" name=\"delete\" value=\"0\" >
                    <div class=\"flexbox_boutton\">
                        <div class=\"bouton\">
                            <input type=\"submit\" value=\"&#10004; Je m'en occupe\" name=\"validation\">
                        </div>
                        <div class=\"bouton\">
                            <input type=\"reset\" onclick=\"show('block','".$mess[0]->getId()."')\" value=\"&#128465; Supprimer (spam)\" name=\"supprimer\">
                        </div>
                    </div>
            </form>
            <div id=\"".$mess[0]->getId()."\">
            Êtes-vous sur de vouloir supprimer ce message?
                <form method=\"post\" action=\"mess.php\">
                    <input type=\"hidden\" name=\"delete\" value=\"1\" >
                    <input type=\"hidden\" name=\"id\" value=\"".$mess[0]->getId()."\">
                    <div class=\"flexbox_boutton\">
                        <div class=\"bouton\">
                            <input type=\"submit\" value=\"Oui\" name=\"Oui\">
                        </div>
                        <div class=\"bouton\">
                        <input type=\"reset\" onclick=\"show('none','".$mess[0]->getId()."')\" value=\"Non\" name=\"Non\">
                        </div>
                    </div>
                </form>
            </div>
            <script type=\"text/javascript\">show('none','".$mess[0]->getId()."');</script>"
        ;
}

if ($mess[0]->getValid()==1){
    echo "<br/><br/><br/>Ce message a été traité par <strong>".$mess[0]->getIdAdmin()."</strong>";
    echo "
    <form method=\"post\" action=\"checkmessage.php\">
    <div class=\"flexbox_boutton\">
        <div class=\"bouton\">
            <input type=\"submit\" value=\"Retourner à la page des messages\" name=\"validation\">
        </div>
    </div>
    </form>";
}

if ($mess[0]->getValid()==2){
    echo "<br/><br/><br/>Ce message a été supprimé par <strong>".$mess[0]->getIdAdmin()."</strong>";
    echo "
    <form method=\"post\" action=\"checkmessage.php\">
    <div class=\"flexbox_boutton\">
        <div class=\"bouton\">
            <input type=\"submit\" value=\"Retourner à la page des messages\" name=\"validation\">
        </div>
    </div>
    </form>";
}
?>
</section>

<?php
require("aside.php");
require("footer.php");
?>