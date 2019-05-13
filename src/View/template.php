<!DOCTYPE html>

<html>
    
    <head>
        <meta charset="UTF-8"/>
    
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <link rel="stylesheet" href="/css/templateStyle.css" />
        
        <?= isset($_COOKIE['lang']) && $_COOKIE['lang']=='elf' ?
            '<link rel="stylesheet" href="/css/elfStyle.css" />' : '' ?>
        
        <title> <?= $title ?> </title>
    </head>

    
    <body>
        <nav class="row notmain">
            <ul>
                <li class="col-md-7">  
                    <a href="/" class="whiteStyle">Uber Licorne</a>
                </li>
                <li class="col-md-1">  
                    <a href="/clients" class="whiteStyle">Clients</a>
                </li>
                <li class="col-md-1"> 
                    <a href="/creatures" class="whiteStyle">Transporteurs</a> 
                </li>
                <li class="col-md-1"> 
                    <a href="/informations" class="whiteStyle">Informations +</a>
                </li>

                <?php 
                    if($GLOBALS['user']) 
                    {
                ?>
                        <li>
                            <a href="index.php?action=deconnexion" class="whiteStyle">Deconnexion</a>
                        </li>
                <?php
                    }       
                    else
                    { 
                ?>
                        <li class="col-md-1"> 
                            <a href="index.php?action=connexion" class="whiteStyle" >Connexion</a> / 
                            <a href="index.php?action=choixInscription" class="whiteStyle">Inscription</a> 
                        </li>
                <?php }
                ?>
                <li class="col-md-1">
                    <a href='' onclick="document.cookie = 'lang=fr'" class="whiteStyle">Fr</a>/
                    <a href='' onclick="document.cookie = 'lang=elf'" class="whiteStyle">Elf</a>
                </li>
            </ul>
        </nav>


        <main>
            <?php 
                if($GLOBALS['user'])
                require("../src/View/User/Profil/menu_membre.php");
            ?>
            <?=$content?>
        </main>


        <footer class="row notmain">
            <ul class="col-xs-3"></ul>
            <ul class="col-xs-3">
                <li><a href="/aPropos" class="whiteStyle">A propos de nous</a></li>
                <li><a href="/contactezNous" class="whiteStyle">Contactez-nous</a></li>
             </ul>
            <ul class="col-xs-3"> 
                <li><a href="/conditionUtilisation" class="whiteStyle">Nos conditions d'utilisations</a></li>      
                <li><a href="/venteAme" class="whiteStyle">Cliquez ici pour vendre votre âme</a></li>
            </ul>
            <ul class="col-xs-3"></ul>
        </footer>
    </body>

</html>