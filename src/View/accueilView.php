<?php $title = "Un merveilleux site pour réserver des licornes ! " ?>

<?php ob_start(); ?>

<section class="row">
    <div class="col-md-4">
        <img src="/image/chocobo.png" alt="image d'un chocobo">
        <img src="/image/licorne.png" alt="image d'une licorne">
        <img src="/image/sahaugin.png" alt="image d'un sahaugin">
    </div>
    <div class="col-md-4">
        <h1>Commandez une course</h1>
        <form method="GET" action="searchCourse">
            Ville de départ :
            <input type=text name=departure id=departure oninput="setTimeout(suggestCity, 150, this, this.value, 'departureSuggestCity')" list="departureSuggestCity" autocomplete="off" required />
            <datalist id="departureSuggestCity"></datalist>
            <br/>
            Ville d'arrivée :
            <input type=text name=arrival id=arrival oninput="setTimeout(suggestCity, 150, this, this.value, 'arrivalSuggestCity')" list="arrivalSuggestCity" autocomplete="off" required />
            <datalist id="arrivalSuggestCity"></datalist>
            <br/>
            <input type=submit value=Rechercher  />
        </form>
    </div>
    <div class="col-md-4">
        <img src="/image/dragon.png" alt="image d'un dragon">
        <img src="/image/phoenix.png" alt="image d'un phoenix">
        <img src="/image/goblin.png" alt="image d'un goblin">
        <img src="/image/halfelin.png" alt="image d'un halfelin">
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

<script src="/js/suggestCity.js"></script>