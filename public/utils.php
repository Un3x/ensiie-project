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



function verifPseudo($pseudo) {//returne true si le pseudo n'existe pas et false sinon
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


function PseudoToId($pseudo) {
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
    $userRepository = new \User\UserRepository($connection);
    $tmpuser=$userRepository->fetchPseudo($pseudo);

    $tmp=$tmpuser->getId();

    return $tmp;
}

function IdToPseudo($id_user) {
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
    $userRepository = new \User\UserRepository($connection);
    $tmpuser=$userRepository->fetchId($id_user);

    $tmp=$tmpuser->getPseudo();

    return $tmp;
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

function verifIdLivre($id) {
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
    
    $livreRepository = new \Livre\LivreRepository($connection);
    $livres = $livreRepository->fetchAll();

    foreach ($livres as $livre) {
        $tmpid=$livre->getId();
        if ($id==$tmpid) {
            return false;
        }
    }
    return true;
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

function estEmprunte($id_livre) {
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
    
    $livreRepository = new \Livre\LivreRepository($connection);
    $livres = $livreRepository->fetchAll();

    foreach ($livres as $livre) {
        $tmpid=$livre->getId();
        if ($id_livre==$tmpid) {
            $tmp=$livre->getEmprunteur();
            if ($tmp != '') {
                return true;
            }
            else {
                return false;
            }
        }
    }
    return false;
}


function IdToTitre($id_livre){
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
    
    $livreRepository = new \Livre\LivreRepository($connection);
    $livres = $livreRepository->fetchAll();

    foreach ($livres as $livre) {
        $tmpid=$livre->getId();
        if ($id_livre==$tmpid) {
            $tmp=$livre->getTitre();
            return $tmp;
        }
    }
    return '';
}


















//fonctions sur les réservations

function estreservLivre($id_livre){
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

    $reservationRepository=new \Reservation\ReservationRepository($connection);

    $reservations = $reservationRepository->fetchAll();

    foreach ($reservations as $reservation) {
        $tmpid=$reservation->getIdLivre();
        if ($id_livre==$tmpid) {
            return true;
        }
    }
    return false;
}

function areservLivre($id_livre) {//retourne l'id de l'utilisateur ayant réservé ce livre
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

    $reservationRepository=new \Reservation\ReservationRepository($connection);

    $reservations = $reservationRepository->fetchAll();

    foreach ($reservations as $reservation) {
        $tmpid=$reservation->getIdLivre();
        if ($id_livre==$tmpid) {
            return $reservation->getIdUser();
        }
    }
}



function livreReserve($id_user) {//retourne l'id du livre réservé par l'utilisateur
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

    $reservationRepository=new \Reservation\ReservationRepository($connection);

    $reservations = $reservationRepository->fetchAll();

    foreach ($reservations as $reservation) {
        $tmpuser=$reservation->getIdUser();
        if ($id_user==$tmpuser) {
            return $reservation->getIdLivre();
        }
    }
    return '';
}

function nbReservation($id_user) {//retourne le nombre de livres réservés par l'utilisateur
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

    $reservationRepository=new \Reservation\ReservationRepository($connection);

    $reservations = $reservationRepository->fetchByUser($id_user);

    $nb = 0;

    foreach ($reservations as $reservation) {
        $nb = $nb+1;
    }
    return $nb;
}







?>