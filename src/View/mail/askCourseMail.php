<?php ob_start(); ?>


<section>
<h2>Un trajet vous est demandé</h2>

détails du trajet : 
<div>
	nom : <?=$name ?> <br/>
	prix : <?=$price ?> €<br/>
	lieu de départ : <?=$departureName ?> <br/>
	lieu d'arrivée : <?=$arrivalName ?> <br/>
</div>

<a href="http://localhost:8080/course/<?=$courseId ?>">plus d'infos</a>

</section>

    

<?php $content = ob_get_clean(); ?>

<?php require('templateMail.php'); ?>

