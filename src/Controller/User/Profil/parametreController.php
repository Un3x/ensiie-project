<?php
require('../src/model/User/UserManager.class.php');
require('../src/Controller/verif.php');


function parametreDebut()
{
    $message="";
    require('../src/View/User/Profil/parametreView.php');
}

function parametreModifPassword()
{
    $message="";
    $userManager = new UserManager(bdd());

    $user = $userManager->get($_SESSION["id_utilisateur"]);

    if( verifierPassword($_POST['password'], $user->getPassword()) && strcmp($_POST['password'],POST['password2']))
    {
        $message="Votre mot de passe a bien été modifié";
        $user->setPassword(hasherPassword($_POST['password']));
        $userManager->update($user);
        //envoyer mail.
        require('../src/View/User/Profil/parametreView.php');
    }
    else
    {
        $message="Erreur rencontrée !";
        require('../src/View/User/Profil/parametreView.php');
    }

}


function parametreSupprimeCompte()
{
    $bdd = bdd();
    $clientManager = new ClientManager($bdd);
    $clientManager->delete($_SESSION["user"]);
    require('../src/View/User/Profil/destructionCompteFinView.php');
}