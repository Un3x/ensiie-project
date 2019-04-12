<?php

function enTete($titre)
{
    print "<!DOCTYPE html>\n";
    print "<html>\n";
    print "  <head>\n";
    print "    <meta charset=\"utf-8\" />\n";
    print "    <title>$titre</title>\n";
    print "    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">";
    print "  </head>\n";
  
    print "  <body>\n";
    print "    <header><h1> $titre </h1></header>\n";
}

function pied(
    echo "</body>";
    echo "</html>";
}


function retour_menu() 
{
    echo "<a href="./Quitter.php>Quitter</a>";
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if ($actual_link != "./index.php"){
      echo "<a href="./index.php>Menu</a>";
    }
/* A compléter lorsque demandé, pour afficher: 
   - un lien de retour vers la page de menu (index.php) si l'on n'est pas dans cette page
   - un lien vers la page de déconnexion (Quitter.php) sur toutes les pages (sauf tpQuitter)
*/
}


function vue_connexion() {

    echo '<section>
        <p> Bonjour, bienvenue sur l\'application de gestion des transactions de gré à gré de biens par particuliers.
        Commencez par vous authentifier </p>

        <br/>

        <form action="tpVerifMDP.php" method="post">
            <label>Entrez votre mot de passe :</label> <input type="password" name="mdp" size="8"/><br/>
            <input type="submit" value="Valider"/>
        </form>
        </section>';

}

function affiche($str) {
    echo $str;
}


function affiche_info($str) {
    echo '<p>'.$str.'</p>';
}

function affiche_erreur($str) {
    echo '<p class="erreur">'.$str.'</p>';
}


function affiche_menu(){
echo '<form action="tpGestionClient.php" method="post">'.
        ajout_champ('number', '', 'numCli', 'Numéro de client', 'numCli', 1).'<br/>'.
	"<fieldset>
	<legend>Choix:</legend>\n".
	ajout_champ("radio", "v", "choix", "Visualisation", "v", 1)."<br/>\n".	
/*

	Ajouter trois champs de menu:
	- un champ Modification
	- un champ Création
	- un champ Achat
*/
	"</fieldset>\n".
	ajout_champ('submit', 'Envoyer', 'soumission', '', '', 0)."\n".
	'</form>';
}	



function affiche_form_modif($numCli, $nomCli,$debitCli){
/*
  Fonction qui créé un formulaire envoyant vers tpModifClient et contient:
  - un champ caché permettant de conserver le numéro du client 
  - un champ texte comprenant le nom actuel du client et permettant de le modifider
  - un champ numérique comprenant le débit actuel du client et permettant de le modifier
  - un champ pour envoyer le formulaire
*/
}


function affiche_form_achat($numCli,$achat){
/*
  Fonction qui créé un formulaire envoyant vers tpNvelAchat et contient:
  - un champ caché permettant de conserver le numéro du client 
  - un champ numérique pour indiquer le montant de l'achat
  - un champ pour envoyer le formulaire
*/

}


function affiche_form_creation($numCli){
echo '<form action="tpCreationClient.php" method="post">'.
        ajout_champ('hidden', $numCli, 'numCli', '', '', 0).'<br/>'.
	ajout_champ("text", '', "nomCli", "Nom client", "nomCli", 1)."<br/>\n".	
	ajout_champ("text", '', "debitInit", "Débit initial", "debitInit")."<br/>\n".	
	ajout_champ('submit', 'Envoyer', 'soumission', '', '', 0)."\n".
	'</form>';
}


function ajout_champ(){
/* fonction qui prend comme arguments dans l'ordre: type, value, name, label, id, (required), (step) 
    (les arguments entre parenthèses ne sont pas obligatoires, mais doivent être à l'index prévu:
    par exemple, si on veut indiquer un argument step, il faut mettre un argument required)
*/

	$tmp='';
	//label
	if(! empty(func_get_arg(3))){
		$tmp.= '<label for="'.func_get_arg(4) .'">'.func_get_arg(3).':</label>';
	}
	$tmp .= '<input type="'.func_get_arg(0).'" ';
	if(! empty(func_get_arg(4))){
		$tmp.= 'id="'.func_get_arg(4).'" ';
	}
	if(! empty(func_get_arg(1))){
		$tmp.= 'value="'.func_get_arg(1).'" ';
	}
	if(! empty(func_get_arg(2))){
		$tmp.= 'name="'.func_get_arg(2).'" ';
	}
	if(func_num_args()>5 && func_get_arg(5)){
		$tmp.= 'required="required" ';
	}
	if(func_num_args() > 6 && func_get_arg(0) == "number" && func_get_arg(6) == -1){
		$tmp .= 'step="any" ';
	}

	$tmp.='>';
	return $tmp;
}


function number_fr($num){
    return number_format($num, 2, ',', ' ');
}


?>
