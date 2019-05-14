<?php
// on teste si nos variables sont définies
if (isset($_SESSION['Utilisateur']))
{
	if(!$_SESSION['Utilisateur']->getIsAdmin())
		$_SESSION['Utilisateur'] = NULL;
}
else
{
    $_SESSION['Utilisateur'] = NULL;
}
