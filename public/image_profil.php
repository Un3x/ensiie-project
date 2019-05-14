<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Photo de profil</title>
    <link rel="stylesheet" href="prrr.css">
</head>
<body>
<header>
    ManAdvisor
</header>

<nav>
    | <a href="deconnexion_user.php" class='nv'>Deconnexion</a> | <a href="profil.php" class="nv">Mon Profil</a> | <a href="modification.php" class="nv">Modifier mon Profil</a> | <a href="recherche.php" class="nv">Rechercher</a> |
</nav>
<br/>
<?php
if (!isset($_GET['avatar'])) {
    echo"<h4 style='color:red;text-align: center'>Choisissez l'avatar qui vous définit le mieux!</h4>";
}
else{
    echo"<h4 style='color:red;text-align: center'>Super, nouvel avatar mis en place!</h4>";
}
?>
<a href='controle1_avatar.php?choix="avatar/avatar1.jpeg"'><img class="avatar"img src='avatar/avatar1.jpeg'></a>
<a href='controle1_avatar.php?choix="avatar/avatar2.jpeg"'><img  class="avatar"img src='avatar/avatar2.jpeg'></a>
<a href='controle1_avatar.php?choix="avatar/avatar3.jpeg"'><img class="avatar"img  src='avatar/avatar3.jpeg'></a>
<a href='controle1_avatar.php?choix="avatar/avatar4.jpeg"'><img  class="avatar"img src='avatar/avatar4.jpeg'></a>
<a href='controle1_avatar.php?choix="avatar/avatar5.jpeg"'><img  class="avatar"img src='avatar/avatar5.jpeg'></a>
<a href='controle1_avatar.php?choix="avatar/avatar6.jpeg"'><img  class="avatar"img src='avatar/avatar6.jpeg'></a>
<a href='controle1_avatar.php?choix="avatar/avatar7.jpeg"'><img  class="avatar"img src='avatar/avatar7.jpeg'></a>
<a href='controle1_avatar.php?choix="avatar/avatar8.jpeg"'><img  class="avatar"img src='avatar/avatar8.jpeg'></a>
<a href='controle1_avatar.php?choix="avatar/avatar9.jpeg"'><img  class="avatar"img src='avatar/avatar9.jpeg'></a>
<a href='controle1_avatar.php?choix="avatar/avatar10.jpeg"'><img  class="avatar"img src='avatar/avatar10.jpeg'></a>
<a href='controle1_avatar.php?choix="avatar/avatar11.jpeg"'><img  class="avatar"img src='avatar/avatar11.jpeg'></a>
<a href='controle1_avatar.php?choix="avatar/avatar12.jpeg"'><img  class="avatar"img src='avatar/avatar12.jpeg'></a>
<a href='controle1_avatar.php?choix="avatar/avatar13.jpeg"'><img  class="avatar"img src='avatar/avatar13.jpeg'></a>
<a href='controle1_avatar.php?choix="avatar/avatar14.jpeg"'><img  class="avatar"img src='avatar/avatar14.jpeg'></a>
<a href='controle1_avatar.php?choix="avatar/avatar15.jpeg"'><img  class="avatar"img src='avatar/avatar15.jpeg'></a>
<a href='controle1_avatar.php?choix="avatar/avatar16.jpeg"'><img  class="avatar"img src='avatar/avatar16.jpeg'></a>
<a href='controle1_avatar.php?choix="avatar/avatar17.jpeg"'><img  class="avatar"img src='avatar/avatar17.jpeg'></a>
<a href='controle1_avatar.php?choix="avatar/avatar18.jpeg"'><img  class="avatar"img src='avatar/avatar18.jpeg'></a>
<a href='controle1_avatar.php?choix="avatar/avatar19.jpeg"'><img  class="avatar"img src='avatar/avatar19.jpeg'></a>
<a href='controle1_avatar.php?choix="avatar/avatar20.jpeg"'><img  class="avatar"img src='avatar/avatar20.jpeg'></a>
</body>
</html>