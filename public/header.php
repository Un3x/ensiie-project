<!DOCTYPE html>
    <html lang="fr">
        <head>
            <meta charset="utf-8" />
            <title>FindYourThing</title>
            <link rel="stylesheet" type="text/css" href="user_head.css"/>
            <link rel="stylesheet" type="text/css" href="signin.css"/>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel="icon" type="image/ico" href="TTT_green.png"/>

        </head>
  
        <body>
            <header><h1><a href="index.php">"Trouve Ton Truc"</a></h1></header>

            <nav>
                <a href="index.php">Accueil</a>
                <div class="dropdown">
                    <button class="dropbtn">Catégories</button>
                    <div class="dropdown-content">
                    <?php 
                    foreach ($cats as $cat) : ?>
                        <a href="<?php echo $cat->getLinkCat(); ?>"><?php
                        if ($cat->getNomCat()=="BONS PLANS"){ 
                            echo "<span class=\"red\">"; 
                            echo $cat->getNomCat(); 
                            echo "</span>";
                        }
                        else echo $cat->getNomCat() ?></a>
                    <?php endforeach; ?>
                    </div>
                </div>
                <a href="contact.php">Contact</a>
                <a href="aboutus.php">A propos</a>
                <button class="boutton" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Connexion</button>
                <form action="" class="search-container">
                    <input type="text" placeholder="Rechercher.." name="search">
                    <button type="submit">OK</button>
                </form>
                <button class="boutton" onclick="window.location.href='ajoutProd.php'" style="width:auto;">Ajouter un produit</button>
            </nav>

            <div id="id01" class="modal">
        
        <form class="modal-content animate" action="/action_page.php">
            <div class="imgcontainer">
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                <img src="img_avatar2.png" alt="Avatar" class="avatar">
            </div>

            <div class="row">
                <h2 style="text-align:center">Connectez-vous avec les réseaux sociaux ou Manuellement</h2>
                
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
                        <input class="signin" type="text" placeholder="Entrez votre Pseudo" name="uname" id="uname" required>
                        <label for="psw"><b>Mot de passe</b></label>
                        <input class="signin" type="password" placeholder="Entrez votre Mot de passe" name="psw" id="psw" required>
                        <button class="boutton" type="submit">Se connecter</button> <br/>
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
                </div>
            </div>
        </form>
        </div>
        <script>
            // Get the modal
            var modal = document.getElementById('id01');

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>

        <div class="flexbox_sect_asi">