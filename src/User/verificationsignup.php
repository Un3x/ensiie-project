<?php

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$id_user = $_POST['id_user'];
$email = $_POST['email'];
$mdp = $_POST['mdp'];
$ville = $_POST['ville'];
$bday = $_POST['bday'];
$pp = $_POST['pp'];
if(empty($nom) && empty($prenom) && empty($id_user) && empty($email) && empty($mdp) && empty($ville) && empty($bday) && empty($pp)){
        print("Un des champs n'est pas rempli");
        exit();
}

function create_client($nom,$prenom,$id_user,$email,$mdp,$ville,$bday,$pp) {

        if ( $db = db_connect()) {
                $reqpseudo = "SELECT id FROM client WHERE id LIKE $id_user";
                $test = db_query($db,$reqpseudo);
                if (test==1){
                        $req1 = "INSERT INTO client(id,firstname,last_name,birthday,loc,email,mdp) VALUES (".test_input($id_user).",'".test_input($prenom)."','".test_input($nom)."','".test_input($bday)."','".test_input($ville)."','".test_input($email)."','".test_input($mdp)."')";
                        $req2 = "INSERT INTO photo_profil(id,adresse) VALUES (".test_input($id_user).")";
                        db_query($db,$req);
                        db_query($db,$req);
                        db_close( $db );
                         return true;
                }
        }
        else {
            return false;
            }
    }


function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
      
?>