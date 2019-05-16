<?php
include("C:/Users/lucky/Desktop/projet web/views/connexion.php");

function check_authentication(){
    global $AUTHENTICATION;
    if(is_null($AUTHENTICATION)){
        header('Status: 301 Moved Permanently', false, 301);//pour preciser que la redirection n'est pas temporaire 
        header('Location: /views/visitor.php');
        exit();
    }
    else{
        header('Status: 301 Moved Permanently', false, 301);//pour preciser que la redirection n'est pas temporaire 
        header('Location: /views/member.php');
    }
}

function create_participant($surname,$name,$promo,$age){
    $id_max=highest_id();
    $req = "INSERT INTO Utilisateur(idUser,prenom,nom,promo,age) VALUES (".$id_max.",'".validate_input($surname).",'".validate_input($name)."','".validate_input($promo).",'".validate_input($age)."')";
    $ans=request_db($req);
    if(!$ans)
        return false;
    else 
        return true;
}

//check password

function validate_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function highest_id(){
    $req = "SELECT MAX(idUser) FROM Utilisateur";
    $ans=request_db($req);
    return $ans;
}

function del_account(){
	
}

function right_corner_header(){
	if(isset($_SESSION['id']) AND isset($_SESSION['pseudo'])){
		connecter($_SESSION['pseudo']);
	}
	else {
		formulaire_connexion();
	}
}
		

?>