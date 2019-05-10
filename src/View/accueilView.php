<?php $title = "Un merveilleux site pour réserver des licornes ! " ?>

<?php ob_start(); ?>

<div>
<form method="GET" action="searchCourse">
    ville de départ :
    <input type=text name=departure id=departure oninput="setTimeout(suggestCity, 150, this, this.value, 'departureSuggestCity')" list="departureSuggestCity" autocomplete="off" required />
    <datalist id="departureSuggestCity"></datalist>
    <br/>

    ville d'arrivée :
    <input type=text name=arrival id=arrival oninput="setTimeout(suggestCity, 150, this, this.value, 'arrivalSuggestCity')" list="arrivalSuggestCity" autocomplete="off" required />
    <datalist id="arrivalSuggestCity"></datalist>
    <br/>

    <input type=submit value=Rechercher  />
    </div>
</form>

<section>

    <p> Ceci est une information. Et ceci est une autre information.</p>
</section>
<section>

        <p> Mais quelle est vraiment le sens de ma vie, dans tout ça ? </p>
    </section>

    

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

<script src="/js/suggestCity.js"></script>

