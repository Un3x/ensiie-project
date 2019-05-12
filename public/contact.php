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
$prodRepository= new \User\ProduitRepository($connection);

$phoRepository=new \User\PhotoRepository($connection);
$MessRepository=new \User\MessageRepository($connection);


require 'connexion.php';

require("header.php");

?>

<section>
<?php 

if (isset($_POST['titre'],$_POST['contenu'],$_POST['mail'])){
    $_POST['mail']=htmlspecialchars($_POST['mail']);
    $_POST['titre']=htmlspecialchars($_POST['titre']);
    $_POST['contenu']=htmlspecialchars($_POST['contenu']);
    $verif=1;
    if ((!filter_var($_POST['mail'],FILTER_VALIDATE_EMAIL)) && $verif==1){
        echo "<span class=\"red\">Votre adresse email n'a pas le bon format</span><br/>";
        $verif=0;
    }

    if ($verif==1){
        echo "Please wait...<br/>";
        $req=$connection->prepare('INSERT INTO "message" (id_mess,titre,contenu,mail,valid) VALUES (:id,:titre,:contenu,:mail,0);');
        $params=array(
            'id' => $MessRepository->getMax()+1,
            'titre' => $_POST['titre'],
            'contenu' => $_POST['contenu'],
            'mail' => $_POST['mail']

        );
        $req->execute($params);
        $_POST['mail']=null;
        $_POST['titre']=null;
        $_POST['contenu']=null;
        echo "<meta http-equiv=\"Refresh\" content=\"2;url=messagesuccess.php\">";
		exit();


    }
}

?>
<div class="form">
    <h1 class="section">Nous contacter</h1>
    <h2 class="sous_titre">Votre message</h2>
    <p>Veuillez compléter les champs suivants.<br>Les champs munis d'un <span class="red">*</span> sont obligatoires.</p>
    <form action="" method="post" class="form">
        <br/>
        <p>Titre de votre message<span class="red">*</span> :</p> <input type="text" size="20" maxlength="50" name="titre" placeholder="Entrez le titre" required> <br/>
<?php
    if ($_SESSION['authent']==1){
        $current=$userRepository->testpseudo($_SESSION['pseudo'])[0];
        echo "<p>Votre pseudo : ".$current->getId()."<br/>Votre email : ".$current->getMail()."</p><br/><input type=\"hidden\" name=\"mail\" value=\"".$current->getMail()."\"";
    }

    else{
        echo "<p>Votre adresse mail<span class=\"red\">*</span> :</p> <input type=\"text\" size=\"20\" maxlength=\"100\" name=\"mail\" placeholder=\"Entrez votre email\" required> <br/>";

    }
?>
        <p>Contenu de votre message<span class="red">*</span> :</p> <textarea name="contenu" cols="80" rows="15" placeholder="Veuillez saisir votre message" required></textarea> <br/>
        <div class="flexbox_boutton">
			<div class="bouton">
				<input type="submit" value="Envoyer" name="inscription_bouton">
            </div>
        </div>
    </form>
</div>
</section>

<?php
require("aside.php");
require("footer.php");
?>