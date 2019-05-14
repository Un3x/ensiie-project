<!DOCTYPE html>
<html lang="fr">
<head>
	<title>CuIsInE</title>
	<meta charset="utf-8">
	<meta name="description" content="Cuisine ENSIIE">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="mainstyle.css">
	<script>
		function validateForm() {
    		var x = document.forms["myForm"]["fname"].value;
   			if (x == null || x == "") {
        	alert("Veuillez entrer votre nom.");
        	return false;
    		}
    	}
    	function submitvote(event) {
			    var checkstatus = event.parentNode.parentNode.getElementsByTagName('input');
			    var infomessage=false;
			    for(var i=0;i<checkstatus.length;i++){
			        if(checkstatus[i].checked){
			            infomessage=true;
			        }
			    }
			    if(infomessage){
			        alert("Merci pour votre choix!");
			    }else{
			        alert("Vous n'avez pas encore fait de choix");
			    }
		}
		
	</script>
</head>
<body>

	<nav>
		<ul class="menu">
			<li id="logo"><b>CuIsInE</b></li>
			<li>
				<a href="#">Activité</a>
				<ul class="sub-menu">
					<li><a href="soiree.html">Soirée</a></li>
					<li><a href="jeudicusine.html">Jeudi Cuisine</a></li>
					<li><a href="concours.html">Concours</a></li>	
				</ul>
			</li>
			<li>
				<a href="#">Recette</a>
				<ul class="sub-menu">
					<li><a href="normale.html">Normale</a></li>
					<li><a href="hallal.html">Halal</a></li>
					<li><a href="vegetarien.html">Végétarien</a></li>
					<li><a href="vegan.html">Végan</a></li>
				</ul>
			</li>
			<li>
				<a href="#">Information</a>
				<ul class="sub-menu">
					<li><a href="administrateurs.html">Administrateurs</a></li>
					<li><a href="membres.html">Membres</a></li>
					<li><a href="mandats.html">Stocks</a></li>
				</ul>
			</li>
		<!-- <li><div id="INSCRIRE"><a href="">S'INSCRIRE</a></div></li> -->
<!-- 		<div id="CONNECTER"><a href="">SE CONNECTER</a></div> -->
		</ul>

<!-- 		<form action="" class="search">
				Chercher sur ce site
				<input type="text" size="20" name="q">
				<input type="submit" value="search" name="sub">
		</form> -->
	</nav>

	<header><b>	Bienvenue chez nous!</b></header>
<div class="main">
	<section class="float">
		<h2>Inscrivez-vous --> </h2>
		<p style="margin-top: 20px;">
			Le thème prochaine est<br>
			<b>Soirée d'or</b> à <div id="timeprochaine"></div>
		</p>
		<p style="margin-top: 10px; margin-bottom: 6px;">
			<img src="soiree.jpeg" width="270" height="240" alt="demonstration theme">
		</p>
		<script type="text/javascript">
			document.getElementById("timeprochaine").innerHTML = new Date("2019-08-25");
		</script>
		<form name="myForm" action="inscrit.php"
			onsubmit="return validateForm()" method="post">
			Nom: <br><input type="text" name="fname"><br>
			Regime alimentaire: <input type="text" name="falimen"><br>
			<input type="submit" value="envoyer">
		</form>
	</section>
	<article style="margin-right: 20px;">
		<img src="main.jpg" alt="Photo publicataire">
	</article>
	<aside>
		<div id="announce">
			<h2 style="color: #333; text-align: center;">NOTIFICATION PUBLICAIRE</h2>
			<ul>
				<li class="boxinfo" style="height: 280px;">
					<h4>Recette proposés la prochaîne fois</h4>
					<form class="vote" method="POST"  action="vote.php">
					<div class="votechoice">
						<ul class="vote1">
							<p>1.Plat：</p>
							<li><input type="checkbox" value="hambruger" /><span class="votechoicename">hambruger</span></li>
							<li><input type="checkbox" value="brownie" /><span class="votechoicename">Bœuf bourguignon</span></li>
							<li><input type="checkbox" value="steak chaliapin" /><span class="votechoicename">steak chaliapin</span></li>
							<li><button type="button" class="button blue" onClick="submitvote(this)">voter</button></li>
						</ul>
					</div><br>
					<div class="votechoice">
						<ul class="vote2">
							<p>2.Dessert：</p>
							<li><input type="checkbox" value="fraisier"><span class="votechoicename">fraisier</span></li>
							<li><input type="checkbox" value="tiramisu" /><span class="votechoicename">tiramisu</span></li>
							<li><input type="checkbox" value="brownie" /><span class="votechoicename">brownie</span></li>
							<li><button type="button" class="button blue" onClick="submitvote(this)">voter</button></li>
						</ul>
					</div>
				</form>
				</li>
				<li class="boxinfo" style="height: 50px;">
					<h4>Où se trouve la clé?</h4>
					<p>au BDE depuis 11/05</p>
				</li>
				<li class="boxinfo" style="height: 70px;">
					<h4>La cusine sera être d'occupeé par XX pendant XX jour </h4>
				</li>
			</ul>
		</div>
	</aside>

</div>
	<footer>
		<p class="">Vous avec besoin du clé de Cusine?</p>
		<div class="contact"><a href="contact.html">Nous contactez</a></div>

	</footer>

</body>
</html>



