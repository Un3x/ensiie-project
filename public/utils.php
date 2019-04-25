<?php

require '../vendor/autoload.php';


//fonctions pour les Users

function genereIdUser() {
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

    $userRepository = new \User\UserRepository($connection);
    $users = $userRepository->fetchAll();

    $ret=0;
    foreach ($users as $user) {
        $tmp=$user->getId();
        if (strnatcmp ($tmp , "$ret")>=0) {
            $ret = (int)$tmp;
            $ret=$ret+1;
        }
    }
    return $ret;
}



function verifPseudo($pseudo) {
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
    
    $userRepository = new \User\UserRepository($connection);
    $users = $userRepository->fetchAll();

    foreach ($users as $user) {
        $tmp=$user->getPseudo();
        if ($tmp == $pseudo) {
            return false;
        }
    }
    return true;
}

function verifNomPrenom($nom, $prenom) {
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
    
    $userRepository = new \User\UserRepository($connection);
    $users = $userRepository->fetchAll();

    foreach ($users as $user) {
        $tmpnom=$user->getNom();
        $tmpprenom=$user->getPrenom();
        if ($nom==$tmpnom && $prenom==$tmpprenom) {
            return false;
        }
    }
    return true;
}


function verifAdmin($id_user) {
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
    
    $userRepository = new \User\UserRepository($connection);
    $users = $userRepository->fetchAll();

    foreach ($users as $user) {
        $tmp=$user->getId();
        if ($tmp==$id_user) {
            if ($user->getAdmin() == 'true') {
                return true;
            }
            else {
                return false;
            }
        }
    }
    return false;
}






//fonctions pour les livres

function genereIdLivre() {
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

    $livreRepository = new \Livre\LivreRepository($connection);
    $livress = $livreRepository->fetchAll();

    $ret=0;
    foreach ($livress as $livre) {
        $tmp=$livre->getId();
        if (strnatcmp ($tmp , "$ret")>=0) {
            $ret = (int)$tmp;
            $ret=$ret+1;
        }
    }
    return $ret;
}


function verifTitre($titre) {
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
    
    $livreRepository = new \Livre\LivreRepository($connection);
    $livres = $livreRepository->fetchAll();

    foreach ($livres as $livre) {
        $tmptitre=$livre->getTitre();
        if ($titre==$tmptitre) {
            return false;
        }
    }
    return true;
}

?>