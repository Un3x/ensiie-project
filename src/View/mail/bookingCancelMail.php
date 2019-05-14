<?php ob_start(); ?>


<section>
<h2>Ce trajet a été annulé</h2>

détails du trajet : 
<div>
	nom : <?=$name ?> <br/>
	prix : <?=$price ?> <img src="http://localhost:8080/image/Pokedollar.png" alt="Pokedollar"><br/>
	lieu de départ : <?=$departureName ?> <br/>
	lieu d'arrivée : <?=$arrivalName ?> <br/>
	distance : <?=$distance ?> ·10<sup>38</sup> l<sub>p</sub><br/>
	durée : <?=$duration ?> ·10<sup>47</sup> t<sub>p</sub><br/>
</div>

<a href="http://localhost:8080/course/<?=$courseId ?>">plus d'infos</a>

</section>

    

<?php $content = ob_get_clean(); ?>

<?php require('templateMail.php'); ?>

