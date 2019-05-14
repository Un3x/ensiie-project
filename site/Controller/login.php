<?php
require_once("../Model/db_data.php");
// on teste si nos variables sont définies
if (isset($_POST['login']) && isset($_POST['pwd'])) 
{
	$isMember = FALSE;
	/**En effet, on a pas besoin du mot de passe pour se connecter
	   à terme, on utilisera la connection AriseID : c'est ce service qui nous
	   indiquera si quelqu'un est connecté ou non : on a juste besoin de l'ID de l'utilisateur
	*/
	$user = db_getUser($_POST['login']);
	$isMember = ($user != NULL);
	if ($isMember) 
    {
		// dans ce cas, tout est ok, on peut démarrer notre session
		// on la démarre 
		session_start ();
		$_SESSION['Utilisateur'] = $user;
    		// on redirige notre visiteur vers une page de notre section membre
        header ('location: ../index.php');
    }
    else 
    {
		// Le visiteur n'a pas été reconnu comme étant membre de notre site. On utilise alors un petit javascript lui signalant ce fait
		echo '<body onLoad="alert(\'Membre non reconnu...\')">';
		// puis on le redirige vers la page d'accueil
		echo '<meta http-equiv="refresh" content="0;URL=../index.php">';
	}
}
else 
{
	echo 'Les variables du formulaire ne sont pas déclarées.';
}
?>