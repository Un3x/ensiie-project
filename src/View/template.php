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
            <div>
                <div class="col-md-7">  
                    <a href="/" class="whiteStyle"><img alt="logo" src="/image/logo_licorne_modified.png">Uber Licorne</a>
                </div>
                <div class="col-md-1">  
                    <br />
                    <a href="/clients" class="whiteStyle">Clients</a>
                </div>
                <div class="col-md-1">
                    <br /> 
                    <a href="/creatures" class="whiteStyle">Transporteurs</a> 
                </div>
                <div class="col-md-1"> 
                    <br />
                    <a href="/informations" class="whiteStyle">Informations +</a>
                </div>

                <?php 
                    if($GLOBALS['user']) 
                    {
                ?>
                        <div class="col-md-1">
                            <br />
                            <a href="/index.php?action=deconnexion" class="whiteStyle">Deconnexion</a>
                        </div>
                <?php
                    }       
                    else
                    { 
                ?>
                        <div class="col-md-1"> 
                            <br />
                            <a href="/index.php?action=connexion" class="whiteStyle" >Connexion</a>
                        </div> 
                        <div class="col-md-1">
                            <br />
                            <a href="/index.php?action=choixInscription" class="whiteStyle">Inscription</a> 
                        </div>
                <?php }
                ?>
                <div class="col-md-1">
                    <br />
                    <a href='' onclick="document.cookie = 'lang=fr'" class="whiteStyle">Fr</a>/
                    <a href='' onclick="document.cookie = 'lang=elf'" class="whiteStyle">Elf</a>
                </div>
            </div>
            <br />
            <br />
        </nav>


        <main>
            <?php 
                if($GLOBALS['user']) {
                    if($_SESSION["userType"] == "Admin")
                    {
                        require("../src/View/Admin/menu_admin.php");
                    }
                    else
                    require("../src/View/User/Profil/menu_membre.php");
                }
            ?>
            <?=$content?>
        </main>


        <footer class="row">
            <ul class="col-md-4"></ul>
            <ul class="col-md-2">
                <li><a href="/aPropos" class="whiteStyle">A propos de nous</a></li>
                <li><a href="/contactezNous" class="whiteStyle">Contactez-nous</a></li>
             </ul>
            <ul class="col-md-2"> 
                <li><a href="/conditionUtilisation" class="whiteStyle">Nos conditions d'utilisations</a></li>      
                <li><a href="/venteAme" class="whiteStyle">Cliquez ici pour vendre votre âme</a></li>
            </ul>
            <ul class="col-md-4"></ul>
            <br />
            <br />
            <br />
            <br />
        </footer>
    </body>

</html>
