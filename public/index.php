<?php
require '../vendor/autoload.php';
session_start();

?>
<html>
	<head>
        <title>Gala ENSIIE</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css"/> 
		<link rel="icon" href="logo_gala_bleu.ico"/> 

		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
    </head>

	<body class="landing">

            <!-- Page Wrapper -->
            <div id="page-wrapper">
      
              <!-- Header -->
              <header id="header" class="alt">
              <?php if (!isset($_SESSION['email'])) {?>
              
                    <span class="menu-bandeau"><a href="connexion.php">Se connecter</a></span>
                    <span class="menu-bandeau"><a href="inscription.php">S'inscrire</a></span>          
              <?php } else {
                 echo "<span class=\"menu-bandeau\"> Bienvenue à toi </span>";
              }?>
              <nav id="nav">
                <ul>
                <li class="special">
                  <a href="#menu" class="menuToggle"><span>Menu</span></a>
                  <div id="menu">
                    <ul>
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="2019.html">Edition 2019</a></li>
                        <li><a href="2018.html">Edition 2018</a></li>
                        <li><a href="2017.html">Edition 2017</a></li>
                        <li><a href="reservation.php">Reserver</a></li>
                    </ul>
                  </div>
                </li>
              </ul>
                </nav>
              </header>
            </div>
        <section id = two class="wrapper style1 special">
            <div>
                <header>
                    <h2><a href="2019.html">Edition 2019</a></h2>
                    <p>
                        Cette année notre merveilleux gala se déroulera au <b>Seven Spirits</b> !
                    </p>
                </header>
            </div>
        </section>

        <section id = three class="wrapper alt style2">
                <div>
                    <header>
                        <h2><a href="2018.html">Edition 2018</a></h2>
                        <p>
                            C'est à l'Aquarium de Paris que l'édition 2018 du gala de l'ENSIIE a plongé pour une nuit pleine de surprises !
                        </p>
                    </header>
                </div>
            </section>
        <section id = four class="wrapper alt style2">
                <div>
                    <header>
                       <h2><a href="2017.html">Edition 2017</a></h2>
                        <p>
                            C'est en 2017 que le gala a lancé une soirée cabaret au Carré Haussman !
                        </p>
                    </header>
                </div>
            </section>

    <!-- Footer -->
       <footer id="footer">
           <img src="Image/logo_gala_blanc.png" class="logo_gala">  
               <ul class="icons">
                    <li><a href="https://www.instagram.com/gala_ensiie/" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
                    <li><a href="https://www.facebook.com/GalaENSIIE/" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
                    <li><a href="mailto:gala@iiens.net" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
                </ul>
            <ul class="copyright">
                <li>&copy; Gala I.I.E</li><li>Design: Gala I.I.E <i>from HTML5 up</i></li>
            </ul>
        </footer>

		<!-- Scripts -->
       
    <script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.scrollex.min.js"></script>
	<script src="assets/js/jquery.scrolly.min.js"></script>
    <script src="assets/js/skel.min.js"></script>
    <script src="assets/js/util.js"></script> 
	<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
	<script src="assets/js/main.js"></script>
</body>
</html>
