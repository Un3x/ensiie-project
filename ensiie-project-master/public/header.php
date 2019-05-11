<header>
<header id="header" class="clear">
<div id="hgroup">
<h1>Challenge Centrale Evry</h1>
</div>
<nav>
<ul>
<li><a href="index.php">Accueil</a></li>
<li><a href="sports.php">Sports</a></li>
<li><a href="faq.php">FAQ</a></li>
<li><a href = <?php
    if (!isset($_SESSION['login']) && !isset($_SESSION['pwd'])) {
        echo '<h4 class="connexion"> <a href="login.php" >Connexion</a>
        &ensp;&ensp;&ensp;
        <a href="register.php" > Inscription </a></h4>';;
    }
    else {
        echo '<h4 class="connexion"> <a href="logout.php" > Se deconnecter </a>
        &ensp;&ensp;&ensp;
        <a href="your_account.php" > Votre compte </a>';
        if (isset($_SESSION['type']) && $_SESSION['type'] == "Organisateur") {
            echo '<br><a href="modify_other.php" > Modifier un autre compte </a>';
        }
        echo '</h4>';
    }
    ?>

</a></li>
</ul>
</nav>
</header>
</header>
