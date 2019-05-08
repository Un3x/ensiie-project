<?php $title = "Un merveilleux site pour réserver des licornes ! " ?>

<?php ob_start(); ?>


<div>
    date : <?=$date ?> <br/>
	nom : <?=$name ?> <br/>
	prix : <?=$price ?> €<br/>
	lieu de départ : <?=$departureName ?> <br/>
	heure de départ : <?=$departureTime ?> <br/>
	lieu d'arrivée : <?=$arrivalName ?> <br/>
	heure d'arrivée : <?=$arrivalTime ?>
</div>

<br/>

<form method="POST" action="/course/confirmation" >
<?php require('../src/View/payment/entryPayment.php'); ?>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('../src/View/template.php'); ?>