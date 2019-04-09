<?php

function create_session($pseudo, $mdp){
	$rows = $this->connection->query('SELECT id, role FROM Membre WHERE pseudo=$pseudo AND mdp=$mdp')->fetchAll(\PDO::FETCH_OBJ);
    $id = -1;
	$role = null;
    foreach ($rows as $row) {
        $id = $row->id;
        $role = $row->role
    }

    if(id == -1){
		return false;
	}

	session_start();
	$_SESSION['id'] = $id;
	$_SESSION['pseudo'] = $pseudo;
	$_SESSION['role'] = $role;

	return true;
}

function destroy_session(){
	$_SESSION['id'] = null;
	$_SESSION['pseudo'] = null;
	$_SESSION['role'] = null;
	session_destroy();
}		

?>
