<?php $title = "Un merveilleux site pour réserver des licornes ! " ?>

<?php ob_start(); ?>


<div>
	nom : <?=$name ?> <br/>
	prix : <?=$price ?> <img src="/image/Pokedollar.png" alt="Pokedollar"><br/>
	lieu de départ : <?=$departureName ?> <br/>
	lieu d'arrivée : <?=$arrivalName ?> <br/>
	distance : <?=$distance ?> <br/>
	durée : <?=$duration ?> <br/>
</div>

<br/>

<form method="POST" action="/course/confirmation" >
<?php require('../src/View/payment/entryPayment.php'); ?>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('../src/View/template.php'); ?>