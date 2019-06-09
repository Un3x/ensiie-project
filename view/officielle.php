<?php
echo '<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" src="./css/login.css">
    <link rel="icon" href="./images/cineevry.ico">
    <link rel="stylesheet" href="./css/filmPlaning.css"/>
    <title>'.$title.'</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="./css/bootstrap.min.css"/>
    

    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/4.0/examples/blog/blog.css" rel="stylesheet">
</head>

<body>
<div class="container">
    <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 text-center">
                <a class="blog-header-logo text-dark" href="/index.php" >CineEvry</a>
            </div><div class="col-4 d-flex justify-content-end align-items-center">';
            if($v_global!='c' && $v_global!='a')
            {
            echo '
                <a class="btn btn-sm btn-outline-secondary" href="/connexion">Se connecter</a>
            
                <a class="btn btn-sm btn-outline-secondary" href="/inscription1" style="margin-left: 10px">s\'inscrire</a>
            
           
            ';
            }
            else {
                echo '<a href="/profilclient" style="margin-right: 3%;"> <img src="./images/avatar.png" height="50px" width="50px" alt="perdu.cm"/></a>';
                echo '<a class="btn btn-sm btn btn-dark" href="/deconnexion">Se deconnecter</a>';
            }
        echo '</div></div>
        
    </header>
    <img src="./images/cinema-header.jpg" height="200" width="100%" alt="photo de cineEvry"/>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/accueil">Accueil <span class="sr-only">(current)</span></a>
      </li>
      
      
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Planning<span class="sr-only">(current)</span>
        </a>';
        if($v_global!='a') {
            echo '
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/affichePday">Planing du jour</a>
          <a class="dropdown-item" href="/afficheWday">Planing de la semaine</a>
          <a class="dropdown-item" href="/affichePSalle">Planning des salles</a>
          </div></li>';
        }
        else {
            echo '
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/addPlaning">Ajouter un planning</a>
          <a class="dropdown-item" href="/afficheplaning">Gestion de la liste des planning</a>
          </div></li>';
        }


    echo '
      
       <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Film<span class="sr-only">(current)</span>
        </a>';
if($v_global!='a') {
        echo '
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/showFilms">Voir la liste des films</a>
          <a class="dropdown-item" href="/filmOfCategories">la liste des films selon categorie</a></div>
      </li>';
}else {
        echo '
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="/addFilm">ajouter un film</a>
            <a class="dropdown-item" href="/showFilms">gérer la liste des films</a>
        </li>';
}

      if($v_global=='c')
      {
          echo '<li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Mes reservation<span class="sr-only">(current)</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/voirMesReservation">Reservation des places</a>
          <a class="dropdown-item" href="/voirMesreserversalle">Reservation des salles</a>
        </div>
      </li>';
      }
        else if($v_global=='a')
      {//          <a class="dropdown-item" href="#">Reservations par planing</a>
          echo '<li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Les reservation<span class="sr-only">(current)</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/allReservationSalle">gérer liste des reservations des salles</a>
          <a class="dropdown-item" href="/allReservationPlace">gérer liste des reservations des places</a>

         
        </div>
      </li>';
      }
      else echo '<li class="nav-item active">
        <a class="nav-link" href="/connexion">Réservation<span class="sr-only">(current)</span></a>
      </li>';





    if($v_global=='a') {
        echo '
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Les admins<span class="sr-only">(current)</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/allAdmins">liste des admins</a>
          <a class="dropdown-item" href="/addnewAdmin">ajouter un admin</a>
        </div>
      </li>
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Les Clients<span class="sr-only">(current)</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/allClients">gérer les clients</a>
        </div>
      </li>
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Autres<span class="sr-only">(current)</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/addFauteuil">ajouter un fauteuil</a>
          <a class="dropdown-item" href="/addevent">ajouter un type evenement</a>
        </div>
      </li>';
    }
      
      echo '
    </ul>
    <form class="form-inline my-2 my-lg-0" action="" method="get">
      <input class="form-control mr-sm-2" type="search" placeholder="Chercher un film" aria-label="Search" name="goFind">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">trouver</button>
    </form>
  </div>
</nav>


    
    '.$body.'
</div>



<footer class="blog-footer" style="position: fixed;
  left: 390px;
  bottom: 0;
  padding-top: 1%;
  padding-bottom: 0%;
  height: 80px;
  width: 59%;
  background-color: #343a40;
  color: white;
  text-align: center;
  ">
    <p>Retrouvez tous les horaires et infos de votre cinéma sur le numéro CineEvry : 06123456789  <br/><a href="#">Projet web ENSIIE 2019</a>.</p>
</footer>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write(\'<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>\')</script>
<script src="./js/popper.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script src="./js/holder.min.js"></script>
<script>
    Holder.addTheme(\'thumb\', {
        bg: \'#55595c\',
        fg: \'#eceeef\',
        text: \'Thumbnail\'
    });
</script>
</body>
</html>';
/**/
?>
