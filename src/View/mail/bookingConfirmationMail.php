<?php ob_start(); ?>


<section>
<h2>Votre demande a bien été enregistrée</h2>

détails du trajet : 
<div>
	date : <?=$date ?> <br/> 
	nom : <?=$name ?> <br/>
	prix : <?=$price ?> €<br/>
	lieu de départ : <?=$departureName ?> <br/>
	heure de départ : <?=$departureTime ?> <br/>
	lieu d'arrivée : <?=$arrivalName ?> <br/>
	heure d'arrivée : <?=$arrivalTime ?> <br/>
</div>

</section>

    

<?php $content = ob_get_clean(); ?>

<?php require('templateMail.php'); ?>

