<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8" />
            <title>FindYourThing</title>
            <link rel="stylesheet" type="text/css" href="user_head.css"/>
            <link rel="stylesheet" type="text/css" href="signin.css"/>
        </head>
  
        <body>
            <header><h1><a href="index.php">"Find Your Thing"</a></h1></header>

            <nav>
                <a href="index.php">Accueil</a>
                <a href="cat1.php">Cat_1</a>
                <a href="cat2.php">Cat_2</a>
                <a href="cat3.php">Cat_3</a>
                <a href="contact.php">Contact</a>
                <a href="aboutus.php">A propos</a>
                <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Connexion</button>
                <form action="" class="search-container">
                    <input type="text" placeholder="Rechercher.." name="search">
                    <button type="submit">OK</button>
                </form>
            </nav>

            <!--<nav>
                <div class="topnav" id="myTopnav">
                    <a href="index.php" class="active">Accueil</a>
                    <div class="dropdown">
                        <button class="dropbtn">Catégories 
                        <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="#">Cat 1</a>
                            <a href="#">Cat 2</a>
                            <a href="#">Cat 3</a>
                        </div>
                    </div> 
                    <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Connexion</button>
                    <form action="" class="search-container">
                        <input type="text" placeholder="Rechercher.." name="search">
                        <button type="submit">OK</button>
                    </form>
                    <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="menuDeroulant()">&#9776;</a>
                </div>
            </nav> 

            <script>
                function menuDeroulant() {
                var x = document.getElementById("myTopnav");
                if (x.className === "topnav") {
                    x.className += " responsive";
                } else {
                x.className = "topnav";
                }
                }
            </script> -->

            <div id="id01" class="modal">
        
        <form class="modal-content animate" action="/action_page.php">
            <div class="imgcontainer">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
            <img src="img_avatar2.png" alt="Avatar" class="avatar">
            </div>

            <div class="row">
                    <h2 style="text-align:center">Connectez-vous avec les réseaux sociaux ou Manuellement</h2>
                <div class="vl">
                     <span class="vl-innertext">ou</span>
                </div>
  
                <div class="col">
                <a href="#" class="fb btn">
                    <i class="fa fa-facebook fa-fw"></i> Login with Facebook
                </a>
                <a href="#" class="twitter btn">
                    <i class="fa fa-twitter fa-fw"></i> Login with Twitter
                </a>
                <a href="#" class="google btn">
                    <i class="fa fa-google fa-fw"></i> Login with Google+
                </a>
                </div>
        
                <div class="col">
                <div class="hide-md-lg">
                    <p>Or sign in manually:</p>
                </div>

            <div class="container">
            <label for="uname"><b>Pseudo</b></label>
            <input class="signin" type="text" placeholder="Entrez votre Pseudo" name="uname" required>

            <label for="psw"><b>Mot de passe</b></label>
            <input class="signin" type="password" placeholder="Entrez votre Mot de passe" name="psw" required>
                
            <button type="submit">Se connecter</button> <br/>
            <label for="remember">Se souvenir de moi</label>
            <input type="checkbox" checked="checked" name="remember">
            </div>

            <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Annuler</button>
            <span class="psw">Forgot <a href="#">password?</a></span>
            </div>
            <div class="bottom-container">
            <div class="row">
            <div class="col">
                <a href="sinscrire.php" style="color:white" class="btn">S'inscrire</a>
            </div>
            <div class="col">
                <a href="#" style="color:white" class="btn">Mot de passe oublié ?</a>
            </div>
            </div>
        </div>
        </form>
        </div>
        </div>
        </div>
        <script src=”signin.js”>
        
        </script>

        <div class="flexbox_sect_asi">