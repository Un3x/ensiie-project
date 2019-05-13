<?php
require_once('../src/Model/User/ClientManager.class.php');
require_once('../src/Controller/verif.php');


function parametreDebut()
{
    $message="";
    require('../src/View/User/Profil/parametreView.php');
}

function parametreModifPassword()
{
    $message = "";
    $bdd = bdd();
    if ($_SESSION["userType"] == "Client") {
        $userManager = new ClientManager($bdd);
    }
    else if ($_SESSION["userType"] == "Vendor")
    {
        $userManager = new VendorManager($bdd);
    }
        $user = $GLOBALS["user"];

    // utiliser password_verify lorsque le hasage sera implemente dans la bdd
        if (password_verify($_POST['passwordOld'], $user->getPassword()) ==0 && strcmp($_POST['password'], $_POST['password2'])==0 )
        {
            $message = "Votre mot de passe a bien été modifié.";
            $user->setPassword(($_POST['password']));
            if($userManager->update($user) != false) {
                //envoyer mail.
                require('../src/View/User/Profil/parametreView.php');
            }
            else
            {
                $message =" Erreur avec le serveur. ";
                require('../src/View/User/Profil/parametreView.php');

            }
        }
        else {
            //$message = $user->getPassword()."/et/".$_POST["passwordOld"]."/et/".$_POST["password"]."/et/".$_POST["password2"];
            require('../src/View/User/Profil/parametreView.php');
        }


}


function parametreSupprimeCompte()
{
    $bdd = bdd();
    if($_SESSION["userType"] == "Vendor")
    {
        $vendorManager = new VendorManager($bdd);
        $vendorManager->delete($GLOBALS["user"]);
    }
    if($_SESSION["userType"] == "Client")
    {
        $clientManager = new ClientManager($bdd);
        $clientManager->delete($GLOBALS["user"]);
    }

    require('../src/View/User/Profil/destructionCompteFinView.php');

}