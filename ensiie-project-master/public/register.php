<?php
    include("ini_session.php");
    if (isset($_SESSION['active']) && $_SESSION['active']) echo '<meta http-equiv="refresh" content="0;URL=index.php">';
    ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
<title>Challenge Centrale Evry</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css?version=211" type="text/css">

<?php include("header.php");?>
</head>

<body>
<div class="abc ligne2">
<div id="block" class="clear">
               	<div id="form_account" class="middle">
               		<script type="text/javascript">
					function valider() {
					  // si la valeur du champ prenom est non vide
					  if(document.formSaisie.email.value != "") {
					    // alors on envoie le formulaire
					    document.formSaisie.submit();
					  }
					  else {
					    // sinon on affiche un message
					    alert("Saisissez l'email");
					  }
					}
					</script>

                    <form action="register_process.php" method="POST" >
                    
                        <p>
                            <br/><br/>
                            <label for="email">Adresse Email :</label>
                            <input type="text" id ="email" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" />
                        </p>
                        <p>
                            <label for="prenom">Prénom :</label>
                            <input type="text" id="prenom" name="prenom" required />
                        </p>
                        <p>
                            <label for="nom">Nom :</label>
                            <input type="text" id="nom" name="nom" required />
                        </p>
                        <p>
                            <label for="genre">Masculin :</label>
                            <input type="radio" id="genre" name="genre" value="m" checked="" />
                            <label for="genre">Féminin :</label>
                            <input type="radio" id="genre" name="genre" value="f" />
                        </p>
                        <p>
                            <label for="tel">Téléphone :</label>
                            <input type="text" id="tel" name="tel" required pattern="[0-9]{10}" />
                        </p>
                        <p>
                        <label for="sport">Choisir un sport:</label>
						<select id="sport" name="sport" required>
						    <option value="">Choix</option>
						    <option value="Basketball">Basketball</option>
						    <option value="Handball">Handball</option>
						    <option value="Parkour">Parkour</option>
						    <option value="Football">Football</option>
						    <option value="Natation">Natation</option>
						    <option value="Tennis">Tennis</option>
						    <option value="Rugby">Rugby</option>
						    <option value="Cheerleading">Cheerleading</option>
						    <option value="Cyclisme">Cyclisme</option>
						</select>
						</p>
                        <p>
                            <label for="pwd">Mot de passe :</label>
                            <input type="password" id="pwd" name="pwd" required />
                        </p>
                        <p>
                            <input type="submit" id="valider" value="Valider" />
                        </p>
                    </form>
                    <form action="index.php" method="POST">
                        <p>
                            <input type="submit" id="cancel" value="Cancel" />
                        </p>
                    </form>
                </div>
            </div>
        </div>

        <?php include("footer.php");?>
    </body>
</html>
