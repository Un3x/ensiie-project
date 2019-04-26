<?php $title = "Un merveilleux site pour réserver des licornes ! " ?>

<?php ob_start(); ?>

ville de départ :
<input type=text id=departure oninput="setTimeout(suggestCity, 150, this, this.value, 'departureSuggestCity')" list="departureSuggestCity" autocomplete="off" value="<?=$departure?>" />
<datalist id="departureSuggestCity"></datalist>
<br/>

ville d'arrivée :
<input type=text id=arrival oninput="setTimeout(suggestCity, 150, this, this.value, 'arrivalSuggestCity')" list="arrivalSuggestCity" autocomplete="off" value="<?=$arrival?>" />
<datalist id="arrivalSuggestCity"></datalist>
<br/>

date :
<input type=date id=date min= <?=date('Y-m-d')?> value="<?=$date?>" />
<br/>

heure :
<input type=time id=time value="<?=$time?>" />
<br/>

<input type=button id=search value=Rechercher onclick="searchCourse('departure', 'arrival', 'date', 'time', 'resDiv')" />

<div id=resDiv></div>    

<?php $content = ob_get_clean(); ?>

<?php require('../src/View/template.php'); ?>


<script src="js/suggestCity.js"></script>
<script src="js/searchCourse.js"></script>
<?=$showResult?>
