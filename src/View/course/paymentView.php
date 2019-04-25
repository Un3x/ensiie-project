<?php $title = "Un merveilleux site pour réserver des licornes ! " ?>

<?php ob_start(); ?>

<div>
    date : <?=$date ?> <br/>
	nom : <?=$name ?> <br/>
	prix : <?=$price ?> €<br/>
	lieu de départ : <?=$departure ?> <br/>
	heure de départ : <?=$departureTime ?> <br/>
	lieu d'arrivée : <?=$arrival ?> <br/>
	heure d'arrivée : <?=$arrivalTime ?>
</div>

 <br/>

<form method="POST" action="index.php?action=payment" >
	paiement : <br/>
	numéro de carte : 
	<input type=text name=nCard /> <br/>
	date d'expiration
	<input type=text name=dateCard /> <br/>
	cryptogramme visuel
	<input type=text name=codeCard /> <br/>
	<input type=submit name=sendInfoCard value="Valider" />
	<input type=hidden value=$idCourse />
</form>


<?php $content = ob_get_clean(); ?>

<?php require('../src/View/template.php'); ?>