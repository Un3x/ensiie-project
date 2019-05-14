<?php $title = "Un merveilleux site pour réserver des licornes ! " ?>

<?php ob_start(); ?>


<div>
	nom : <?=$name ?> <br/>
	prix : <?=$price ?> <img src="/image/Pokedollar.png" alt="Pokedollar"><br/>
	lieu de départ : <?=$departureName ?> <br/>
	lieu d'arrivée : <?=$arrivalName ?> <br/>
	distance : <?=$distance ?> ·10<sup>38</sup> l<sub>p</sub><br/>
	durée : <?=$duration ?> ·10<sup>47</sup> t<sub>p</sub><br/>
</div>

<br/>

<form method="POST" action="/course/confirmation" >
<?php require('../src/View/payment/entryPayment.php'); ?>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('../src/View/template.php'); ?>