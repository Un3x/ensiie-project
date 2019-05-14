<?php

/**
 *  \brief : foncition qui ecrit l'en tete de la page
 *  \param : $titre le titre de la page actuel
 */
function entete($titre)
{
    echo '  <!DOCTYPE htm>
            <html>
                <head>
                    <meta charset = "utf-8">
                    <title>' . $titre . '</title>
                    <link rel = "stylesheet" 
                        type = "text/css" href="projet.css">
                </head>
                <body>
                    <header><h1>' . $titre . '</h1></header>';
}

/**
 *  \brief : fonction qui affiche le bas de page 
 */
function pied()
{
    echo '
                    <footer>
                        <a href="apropos.php">A propos</a>
                    </footer>
                </body>
            </html>';
}

/**
 *  \brief : fonction  qui affiche le formmulaire de connexion 
 */
function formulaireConnexion()
{
    echo '
        <h3>Connexion</h3>
        <form method = "post" action ="connexion.php">
            <label>Pseudo :</label>
                <input type = "text" name ="pseudo"><br/></br>
            <label>Password :</label>
                <input type="password" name="mdp"><br/><br/>
            <p>
                <select id="status" name="status">
                    <option value="inscrit">inscrit</option>
                    <option value="administrateur">administrateur</option>
                </select>
            </p>
            <input type="submit" value="Se connecter"><br/>
        </form>

    ';
}


/**
 *  \breif : fonction qui affiche le formulaire d'inscription
 */
function formulaireInscription()
{
    echo '
    <h3>Inscription :</h3>
    <form action="inscription.php" method="post" class="formulaire">
        <label>	Mail : </label><input type="email" name="mail" style="width: 200px" placeholder="prenom.nom@gmail.com" id="mail"/><br /><br/>
        <label>	Pseudo : </label><input type="text" name="pseudo" placeholder="sparrow" id="pseudo"><br /><br/>
        <label>	Nom :</label> <input type="text" name="nom" placeholder="RAHJ" /id="nom"><br />  <br/>
        <label>	Prenom : </label><input type="text" name="prenom" placeholder="Hicham" id="prenom" /><br /><br/>
        <label>	Date de naissance : </label><input type="date" name="dateDeNaissance" placeholder="1998-07-13" id="date"><br/><br/>
        <label>Adresse : </label><input type="text" name="addresse" id="add">
        <p>
            <label>	Sexe :</label> 
            <select id="sexe" name="genre" id="sexe">
                <option value="homme">Homme</option>
                <option value="femme">Femme</option>
                <option value="bi">Les deux</option>
            </select>
        </p>
        <label>	Num etudiant : </label><input type="number" name="numEtudiant" id="num"><br/><br/>
        <label>	Password : </label><input type="Password" name="mdp" id="mdp"><br /><br/>
        <label>	Comfirm password :</label> <input type="password" name="mdp2" id="mdp2"><br/><br/><br/>
        <input type="submit" value="s\'inscrire" id="inscrire">
    </form>
<script type="text/javascript" language="Javascript" src="jquery.js"></script>
<script type="text/javascript">
	$(function(){
		$("#inscrire").click(function(){
			valid = true;
			if($("#nom").val()== ""){
				$("#nom").css("border-color","#FF0000");
				valid=false;
			}
			if($("#prenom").val()== ""){
  				$("#prenom").css("border-color","#FF0000");
  				valid=false;
			}
			if($("#mail").val()== ""){
				$("#mail").css("border-color","#FF0000");
			  	valid=false;
			
			}
			if($("#pseudo").val()== ""){
				$("#pseudo").css("border-color","#FF0000");
			  	valid=false;
			}
			if($("#date").val()== ""){
				$("#date").css("border-color","#FF0000");
			  	valid=false;
			}
			if($("#add").val()== ""){
				$("#add").css("border-color","#FF0000");
			  	valid=false;
			}
			if($("#sexe").val()== ""){
				$("#sexe").css("border-color","#FF0000");
			  	valid=false;
			}
			if($("#num").val()== ""){
				$("#num").css("border-color","#FF0000");
			  	valid=false;
			}
			if($("#mdp").val()== ""){
				$("#mdp").css("border-color","#FF0000");
			  	valid=false;
			}
			if($("#mdp2").val()== ""){
				$("#mdp2").css("border-color","#FF0000");
			  	valid=false;
			}
			return valid;
		});
	});
</script>
    ';

}

/**
 *  \brief : fonction qui affiche le profil de l'utilisateur
 */
function afficherProfil()
{
    echo "
        <p>Bonjour Mr/Mme $_SESSION[nom], $_SESSION[prenom] aka $_SESSION[pseudo]</p>
        <ul class=\"profil\">
            <li class=\"profil\"><label>Date de Naissance </label>: $_SESSION[dateDeNaissance] </li>
            <li class=\"profil\"><label>Mail </label>: $_SESSION[mail]</li>
            <li class=\"profil\"><label>Numero d'étudiant </label>: $_SESSION[numEtudiant]</li>
            <li class=\"profil\"><label>Genre</label>: $_SESSION[genre]</li>
            <li class=\"profil\"><label>Adresse </label>: $_SESSION[addresse]</li>
        </ul>
        <form method = \"post\" class = \"formulaire\" action =\"updateProfil.php\">
                        <input type = \"submit\" value=\"modifier\">
            </form>
    ";
}

/**
 *  \brief : fonction qui affiche le formulaire de modification du profil
 *  \param : les valeurs actuel dans la table utilisateur
 */
function formulaireUpdateProfil($dateDeNaissance,
                                $mail,
                                $adresse)
{
    echo '
    <h3>Modification des infos :</h3>
    <form action = updateProfil.php method = "post">
        <label> Mail :</label>
            <input type = "text" name = "mail" style = "width : 200px" value=' . $mail . '><br/><br/>
        <label> Date De Naissance :</label>
            <input type = "text" name="dateDeNaissance" value  ='. $dateDeNaissance.'><br/><br/>
        <label>Adresse : </label>
            <input type ="text" name="addresse" value ='. $adresse . '>
        <p>
            <label>Sexe:</label>
                <select id="sexe" name="genre">
                    <option value = "homme">Homme</option>
                    <option value = "femme" >Femme</option>
                    <option value = "Les deux">Les deux</option>
                </select>
        </p>
        <input type ="submit" value = "modifier">
    </form>
    ';
}

/**
 *  \brief : foncction qui affiche le formulaire de changement de mot de passe
 */
function formulaireChangementMdp()
{
    echo '
    <h3>Modification du mot de passe</h3>
    <form action="updateProfil.php" method = "post">
        <label>Nouveau mot de passe :</label>
            <input type = "password" name ="nvxmdp"><br/><br/>
        <label>Comfirmer mot de passe :</label>
            <input type ="password" name ="nvxmdp2"><br/><br/>
    
        <label>Ancient mot de passe :</label>
            <input type ="password" name ="mdp"><br/><br/>
        <input type ="submit" value ="modifier">
    </form>
    ';
}

/**
 *  \brief : fonction qui permet la navigation dans le site web
 */
function navigation($status)
{
    echo '<h3>Navigation :</h3>';
    echo '
    <nav>
        <ul>
            <li><a href = "index.php">Deconnexion</a></li>
            <li><a href = "profil.php">Profil</a></li>
            <li><a href = "recherche.php">Recherche</a></li>
    ';

    if( $status == "administrateur")
    {
        echo '<li><a href = "gestionInscrit.php">Gestion des inscrits</a></li>';
    }

    echo '
        </ul>
    </nav>
        ';
}
?>
