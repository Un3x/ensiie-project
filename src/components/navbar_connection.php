<?php if (isset($_SESSION['connected'])): ?>

<div class="navbar-container">
    <h1><a href="#">TSPS</a></h1>
    <nav id="landing-nav">
        <ul class="nav-link">
            <li><a href="reset_session.php">Déconnexion</a></li>
            <li><a href="profile.php">Mon profil</a></li>
            <li class="v-link"><a href="#">Entraînements</a></li>
            <li class="v-link"><a href="documents.php">Documents</a></li>
            <li class="v-link"><a href="discussions.php">Discussions</a></li>
        </ul>
    </nav>
</div>
<div class="sidebar-container">
    <h1><a href="index.php">TSPS</a></h1>
    <a id="nav-toggle" href="#">&#9776;</a>
    <div id="sidebar-nav"></div>
</div>

<?php else: ?>

<div class="navbar-container">
    <h1><a href="index.php">TSPS</a></h1>
    <nav id="landing-nav">
        <ul class="nav-link">
           <li><a href="presentation.php">Espace lycéen</a></li>
           <li><a href="signup.php">Inscription</a></li>
            <li><a href="login.php">Connexion</a></li>
        </ul>
    </nav>
</div>
<div class="sidebar-container">
    <h1><a href="index.php">TSPS</a></h1>
    <a id="nav-toggle" href="#">&#9776;</a>
    <div id="sidebar-nav"></div>
</div>

<?php endif ?>