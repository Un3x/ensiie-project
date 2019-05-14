<header>
<div class="flex_div_principal">
<img class="logo_site" src="logo2.png" alt="logo apero foot"/>
<nav class="menu_principal">
<a href="accueil.php" class="lien_menu_principal">Accueil</a>
<a href="accueil_recherche.php" class="lien_menu_principal"> <i class="fas fa-search"></i> Recherche</a>
<a href="accueil_proposition.php" class="lien_menu_principal">Proposer un match</a>
<?php
session_start();
     if (isset($_COOKIE['id'])){
    session_start();
    $_SESSION['id'] = $_COOKIE['pseudo'];

}
     
     if (isset($_SESSION['id'])){
        ?>
        <a href="mon_compte.php" class="lien_menu_principal">Mon compte</a>
        <?php
    }
    else {
        ?>
        <a href="connexion.php" class="lien_menu_principal">Inscription/Connexion</a>
        <?php
    }
?>
</nav>
</div>
</header>
<main class="main_content">