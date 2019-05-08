<?php
if (isset($_SESSION['authent'])) {
    if (isset($_POST['uname'], $_POST['psw'])) {
        $peusdo = htmlspecialchars($_POST['uname']);
        $password = htmlspecialchars($_POST['psw']);
        foreach ($users as $utilisateur) {
            if ($utilisateur->getId() == $peusdo && $utilisateur->getMdp() == $password) {
                $_SESSION['authent'] = 1;
                $_SESSION['statut'] = $utilisateur->getAdministrateur();
                $_SESSION['pseudo'] = $utilisateur->getId();
            }
        }
    }
}
?>