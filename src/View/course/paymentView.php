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
	paiement : (NE SOYEZ PAS CONS NE METTEZ PAS DE VRAIS INFOS DE CB !!!!) <br/>
	numéro de carte : 
	<input type=text name=nCard pattern='^[0-9]{16}$' required/> <br/>
	
    date d'expiration
    <select name=monthCard required>
        <?php for($i=1; $i<=12; $i++){
            echo "<option>".sprintf("%02d" ,$i)."\n";
            }
        ?>
    </select>
    <select name=yearCard required>
        <?php for($i=0; $i<=20; $i++){
            echo "<option>".($i + date("Y"))."\n";
            }
        ?>
    </select> <br/>

    cryptogramme visuel
	<input type=text name=codeCard pattern='^[0-9]{3}$' required/> <br/>
	
    <input type=submit name=sendInfoCard value="Valider" />
	<input type=hidden value=$idCourse />
</form>


<?php $content = ob_get_clean(); ?>

<?php require('../src/View/template.php'); ?>