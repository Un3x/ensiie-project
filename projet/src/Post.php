<?php 
/* création d'un thread avec son premier message */
fuction create_thread()
{
	echo '<form action="CreationThread.php" method="post">'.
	ajout_champ("text", '', "theme", "Theme", '', 0).'<br/>'.
	ajout_champ("text", '', "titre", "Titre", '', 0).'<br/>'.
	ajout_champ("text", '', "contenu", "Message", '', 1)."<br/>\n".
	'<input type="submit" value="Créer Thread" name="bouton1"/>
    </form>';
}

/* Créer un post qui répond à un autre post dont on connaît le thread et
l'id du message auquel on répond*/
function answer_post($id_thread, $id_post_avant)
{
	echo '<form action="AnswerPost.php" method="post">'.
	/*'<h1>$titre</h1>. en récupérant le titre du thread à partir de son id*/
	'<p>$theme</p>'.
	ajout_champ('hidden', $id_thread, 'id_thread', '', '', 0).'<br/>'.
	ajout_champ('hidden', $id_post_avant, 'id_post_avant', '', '', 0).'<br/>'.
	ajout_champ("text", '', "contenu", "Message", '', 1)."<br/>\n".
	'<input type="submit" value="Répondre" name="bouton2"/>
    </form>';
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
?>
