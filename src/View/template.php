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
        <nav class="row">
            <ul>
                <li class="col-md-7">
                    <a href='' onclick="document.cookie = 'lang=fr'" >Fr</a>/
                    <a href='' onclick="document.cookie = 'lang=elf'" >Elf</a>
                </li>
                <li class="col-md-1">  
                    <a href="/">Uber Licorne</a>
                </li>
                <li class="col-md-1">  
                    <a href="/clients">Clients</a>
                </li>
                <li class="col-md-1"> 
                    <a href="/creatures">Transporteurs</a> 
                </li>
                <li class="col-md-1"> 
                    <a href="/informations">Informations +</a>
                </li>

                <?php 
                    if($GLOBALS['user']) 
                    {
                ?>
                        <li>
                            <a href="index.php?action=deconnexion">Deconnexion</a>
                        </li>
                <?php
                    }   
                    else
                    { 
                ?>
                        <li class="col-md-1"> 
                            <a href="index.php?action=connexion" >Connexion</a> / 
                            <a href="index.php?action=choixInscription">Inscription</a> 
                        </li>
                <?php }
                ?>
            </ul>
        </nav>


        <main>
            <?php 
                if($GLOBALS['user'])
                require("../src/View/User/Profil/menu_membre.php");
            ?>
            <?=$content?>
        </main>


        <footer class="row">
            <ul class="col-xs-6">
                <li>A propos de nous</li>
                <li>Contactez-nous</li>
             </ul>
            <ul class="col-xs-6"> 
                <li>Nos conditions d'utilisations</li>      
                <li>Cliquez ici pour vendre votre âme </li>
            </ul>
        </footer>
    </body>

</html>