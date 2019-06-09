<?php $title = 'CinemaEvry'; ?>
<?php ob_start();?>
    <img src="./images/cinema-header.jpg" height="200" width="100%" alt="photo de cineEvry"/>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">CineEvry</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="/travail">Accueil</a></li>
                <li><a href="/addPlaning">planing</a></li>
                <li><a href="#">Réservation</a></li>
                <li><a href="/derniernews">dernières news</li>
            </ul>
            <form class="navbar-form navbar-left" action="/action_page.php">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="..">
                </div>
                <button type="submit" class="btn btn-default">Chercher</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-user"></span> Inscription</a></li>
                <li><a href="/connexion"><span class="glyphicon glyphicon-log-in"></span> Connexion</a></li>
            </ul>
        </div>
    </nav>
<?php $cineNav=ob_get_clean() ?>
<?php ob_start(); ?>
    <h1>Mon super blog !</h1>
    <p>Derniers billets du blog :</p>

    <div class="news">
        <h3>
            <?php if(isset($commentaire['firstname'])) { echo $commentaire['firstname']." + ".$commentaire['lastname']."<em>le  ".$commentaire['birthday']."</em>";}

            echo "PAgeIndexView.php";
            ?>

        </h3>
    </div>
<?php $content = ob_get_clean(); ?>