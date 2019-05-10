<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8"/>
    
    <!-- Latest compiled and minified CSS -->
    
    <?= isset($_COOKIE['lang']) && $_COOKIE['lang']=='elf' ?

        '<link rel="stylesheet" href="/css/elfStyle.css" />' :

        '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">'

    ?>
    
    <title> <?= $title ?> </title>

</head>
<body>


<nav>
    <ul>
    <li>
        <a href='' onclick="document.cookie = 'lang=fr'" >fr</a>
        /
        <a href='' onclick="document.cookie = 'lang=elf'" >elf</a>
    </li>
    <li>  
        <a href="/" > Accueil  </a>
    </li>

    <li>  
        <a href="/clients" > Clients  </a>
    </li>

    <li> 
        <a href="/creatures"> Créatures/Transporteurs </a> 
    </li>

    <li> 
        <a href="/informations"> Plus d'informations </a>
     </li>

<?php 
    if( $connecte) 
    { ?>
        <li>
            <a href="index.php?action=deconnexion" > Deconnexion </a>
        </li>
        <?php
    }
    else
    {
    ?>

    <li> 
        <a href="index.php?action=connexion" >Connexion  </a> 
         / 
        <a href="index.php?action=choixInscription"> Inscription </a> 
    </li>

    <?php }
    ?>

    </ul>

</nav>

<?php if($connecte)
    {
        require("../src/View/User/Profil/menu_membre.php");
    }
    ?>


<?=$content?>

<footer>
    Ceci est un pied de page. 
    L. Copyright.
    <ul>
        <li> A propos de nous </li>
        <li>Contactez-nous</li>
        <li> Nos conditions d'utilisations</li>
        <li> Cliquez ici pour vendre votre âme </li>
    </ul>

    <?=$script?>

</footer>
</body>
</html>