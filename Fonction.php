
<?php
function nb_pts_communs($id1,$id2){

    require '../vendor/autoload.php';

    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

    $userRepository = new \User\UserRepository($connection);
    $users = $userRepository->fetchAll();


    $req = $connection->query("SELECT COUNT(*) as nb FROM (SELECT type_jeu FROM interet WHERE id_personne=$id1 INTERSECT SELECT type_jeu FROM interet WHERE id_personne=$id2) as foo");
    $donnees = $req->fetch();
    $res1=$donnees['nb'];

    $req = $connection->query("SELECT COUNT(*) as nb FROM (SELECT plateforme FROM interet WHERE id_personne=$id1 INTERSECT SELECT plateforme FROM interet WHERE id_personne=$id2) as foo");
    $donnees = $req->fetch();
    $res2=$donnees['nb'];

    $req = $connection->query("SELECT COUNT(*) as nb FROM (SELECT sport_individuel FROM interet WHERE id_personne=$id1 INTERSECT SELECT sport_individuel FROM interet WHERE id_personne=$id2) as foo");
    $donnees = $req->fetch();
    $res3=$donnees['nb'];

    $req = $connection->query("SELECT COUNT(*) as nb FROM (SELECT sport_collectif FROM interet WHERE id_personne=$id1 INTERSECT SELECT sport_collectif FROM interet WHERE id_personne=$id2) as foo");
    $donnees = $req->fetch();
    $res4=$donnees['nb'];

    $req = $connection->query("SELECT COUNT(*) as nb FROM (SELECT categorie_film FROM interet WHERE id_personne=$id1 INTERSECT SELECT categorie_film FROM interet WHERE id_personne=$id2) as foo");
    $donnees = $req->fetch();
    $res5=$donnees['nb'];

    $req = $connection->query("SELECT COUNT(*) as nb FROM (SELECT genre_litteraire FROM interet WHERE id_personne=$id1 INTERSECT SELECT genre_litteraire FROM interet WHERE id_personne=$id2) as foo");
    $donnees = $req->fetch();
    $res6=$donnees['nb'];

    $req = $connection->query("SELECT COUNT(*) as nb FROM (SELECT genre_musical FROM interet WHERE id_personne=$id1 INTERSECT SELECT genre_musical FROM interet WHERE id_personne=$id2) as foo");
    $donnees = $req->fetch();
    $res7=$donnees['nb'];

    $req = $connection->query("SELECT COUNT(*) as nb FROM (SELECT instrument FROM interet WHERE id_personne=$id1 INTERSECT SELECT instrument FROM interet WHERE id_personne=$id2) as foo");
    $donnees = $req->fetch();
    $res8=$donnees['nb'];

    $req = $connection->query("SELECT COUNT(*) as nb FROM (SELECT religion FROM interet WHERE id_personne=$id1 INTERSECT SELECT religion FROM interet WHERE id_personne=$id2) as foo");
    $donnees = $req->fetch();
    $res9=$donnees['nb'];

    $req = $connection->query("SELECT COUNT(*) as nb FROM (SELECT regime_alimentaire FROM interet WHERE id_personne=$id1 INTERSECT SELECT regime_alimentaire FROM interet WHERE id_personne=$id2) as foo");
    $donnees = $req->fetch();
    $res10=$donnees['nb'];

    $req = $connection->query("SELECT COUNT(*) as nb FROM (SELECT alcool FROM interet WHERE id_personne=$id1 INTERSECT SELECT alcool FROM interet WHERE id_personne=$id2) as foo");
    $donnees = $req->fetch();
    $res11=$donnees['nb'];

    return $res1+$res2+$res3+$res4+$res5+$res6+$res7+$res8+$res9+$res10+$res11;

}

function pers_ideale($id)
{

    require '../vendor/autoload.php';

    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

    $i=0;
    $j=0;
    $res=0;
    while($i <= 3) {
        if($i==$id){
            $i=$i+1;
        }
        if($j < nb_pts_communs($i, $id)){
            $j=nb_pts_communs($i, $id);
            $res=$i;
            $i = $i + 1;
        }
        else {
            $i = $i + 1;
        }
    }

    $req = $connection->query("SELECT prenom as foo from Person WHERE id_personne = $res");
    $donnees = $req->fetch();
    $final=$donnees['foo'];
    return $final;
}

function membres_id_prenom($id){
    require '../vendor/autoload.php';

    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

    $requser=$connection->prepare("SELECT * FROM Person WHERE id_personne = ?");
    $requser->execute(array($id));
    $userinfo=$requser->fetch();
    return $userinfo['prenom'];
}

function membres_id_nom($id){
    require '../vendor/autoload.php';

    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

    $requser=$connection->prepare("SELECT * FROM Person WHERE id_personne = ?");
    $requser->execute(array($id));
    $userinfo=$requser->fetch();
    return $userinfo['nom'];
}

?>