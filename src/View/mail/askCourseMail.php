<?php ob_start(); ?>


<section>
<h2>Un trajet vous est demandé</h2>

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

<a href="http://localhost:8080/index.php?action=infoCourse&courseId=<?=$courseId ?>">plus d'infos</a>

</section>

    

<?php $content = ob_get_clean(); ?>

<?php require('templateMail.php'); ?>

