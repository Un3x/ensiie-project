<?php
session_start();
include("config.php");
include("db.php");

function verif_authent(){
    global $AUTHENT;
    /*
      Complétez cette fonction pour que si la variable AUTHENT est positionnée à 1 et que la variable de session 
      comprenant le nom d'utilisateur nomuser n'est pas positionnée, l'utilisateur soit redirigé vers la page tpConnexion.php
      (voir fonction header() de php)
    */
}

function config() {
    global $nom_hote, $nom_user, $nom_base, $mdp;
    $_SESSION['nomhote'] = $nom_hote;
    $_SESSION['nombase'] = $nom_base;
    $_SESSION['nomuser'] = $nom_user;
    $_SESSION['mdp'] = $mdp;
}



function get_client($numCli)
{

/*
Cette fonction doit exécuter une requête SELECT permettant de récupérer le nom et le débit d'un client de numéro donné
et retourner un tableau comprenant trois valeurs:
- une première valeur donnant une information sur l'exécution: 0 si tout s'est bien passé, -1 si aucun client n'a été trouvé avec le numéro donné, -2 si la requête n'a pas pu être exécutée, -3 si la connexion à la BD n'a pas réussi
- la seconde valeur donne le nom du client si tout s'est bien passé, 0 sinon
- la troisième valeur donne le débit du client si tout s'est bien passé, 0 sinon
*/
    $result = array(-3,0,0);
    if ( $db = db_connect()) { /*test de connexion*/
		$req = "SELECT nom_client, debit_client FROM client WHERE num_client = $numCli";
	    if ($rep = db_query($db,$req)){ /*test de la requête*/
            $row = pg_fetch_row($rep);
            if ($row[0]== NULL) { /*test s'il n'y a pas de client*/
                $result[0]=-1; /*aucun client trouvé*/
            }
            else { /*tout s'est bien passé*/
                $result[0]=0;
                $result[1]=$row[0];
                $result[2]=$row[1];
            }
        }
        else {
            $result[0]=-2;/*la requête a échoué*/
        }
    }
    db_close( $db );
    /*
	}
    else {
        $result[0]=-3;
    }
    mais c'est la valeur par défaut
    */
    return($result);
}

function insert_achat($numCli,$montant) {
/*
  Cette fonction doit effectuer une transaction qui:
  - met à jour le débit du client du numéro concerné (après avoir testé la valeur entrée par l'utilisateur si possible)
  - insère un nouvel achat dans la base
  Il faudra utiliser une transaction pour garder une base cohérente même en cas d'erreur.
*/
}


function create_client($numCli,$nomCli,$debitInit) {

    if ( $db = db_connect()) {
		$req = "INSERT INTO client(num_client,nom_client,debit_client) VALUES (".test_input($numCli).",'".test_input($nomCli)."','".format_number(test_input($debitInit))."')";
		db_query($db,$req);
		db_close( $db );
		return true;
	}
	else {
		return false;
	}
}


function set_client($numCli,$nomMod,$debitMod) {
    if ( $db = db_connect()) {
        $req = 'UPDATE client SET nom_client = \''.test_input($nomMod).'\', debit_client = \''.format_number(test_input($debitMod)).'\' WHERE num_client = '.test_input($numCli);

        $rep = db_query($db,$req);
        db_close( $db );

        return true;
    }
    else {
        return false;
    }

}

function verif_mdp($mdp) {

	if ($db = db_connect()) {
		$_SESSION['mdp']=$mdp;
		db_close($db);
		return true;
	} else
		return false;

}

function detruire_session() {
	session_destroy();
}




function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}





function format_number($str) {
  return str_replace(',','.',$str);
}







