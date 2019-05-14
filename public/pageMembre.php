<?php session_start(); 
$_SESSION['adresse'] = "pageMembre.php";
if (!isset($_SESSION['authent'])) $_SESSION['authent']=0;
require("connexion.php");?>

<!DOCTYPE html>


<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Firewolf</title>
    <link rel="icon" type="image/png" href="logo.png" id="im" />
    <link rel="stylesheet" href="style.css"/>
  </head>

      <body> 
      
      <nav>
<?php
if ($_SESSION['authent']==0) {
  echo "
  <ul class=\"topnav\">
  <li><a href=\"accueil.php\">Home</a></li>
  <li><a href=\"pageMembre.php\" class=\"active\">Membres</a></li>
  <li><a href=\"rn_tmp.php\">Rejoins-nous</a></li>
  <li class=\"right\"><a onclick=\"document.getElementById('id01').style.display='block'\">Connexion</a></li>
  </ul>";
}
else {
  if ($_SESSION['statut']=='M') {
    echo "
    <ul class=\"topnav\">
    <li><a href=\"accueil.php\">Home</a></li>
    <li><a href=\"profil.php\">Profil</a></li>
    <li><a href=\"pageMembre.php\" class=\"active\">Membres</a></li>
    <li><a href=\"inscrits.php\">Inscrits</a></li>
    <li><a href=\"nathane/gain.php\">Nathane</a></li>
    <li><a href=\"aime/comment.php\">Aimé</a></li>
    <li class=\"right\"><a href=\"deconnexion.php\">Déconnexion</a></li>
    </ul>";
  }
  else {
    echo "
    <ul class=\"topnav\">
    <li><a href=\"accueil.php\">Home</a></li>
    <li><a href=\"profil.php\">Profil</a></li>
    <li><a href=\"pageMembre.php\" class=\"active\">Membres</a></li>
    <li><a href=\"rn_tmp.php\">Rejoins-nous</a></li>
    <li class=\"right\"><a href=\"deconnexion.php\">Déconnexion</a></li></ul>";
  }
}
?>
</nav>


<style> 
[class*="col-"] {
  float: left;
  padding: 60px;
}

/* For desktop: */

.col-2 {width: 60%;}
.col-1 {width: 40%;}
.justify {text-align: justify;}
@media only screen and (max-width: 800px) {
  /* For mobile phones: */
  [class*="col-"] {
    width: 100%;
  }
}
</style> 


<?php
if (isset($_SESSION['try_rn']) && $_SESSION['try_rn']==1) {
  echo "<span class=\"warning\">Pour nous rejoindre, tu dois d'abord te connecter.</span></br>";
  $_SESSION['try_rn'] = 0;
}
if (isset($_SESSION['fail_connect'])) {
  if ($_SESSION['fail_connect']==1) {
    echo "<span class=\"warning\">Pseudo ou mot de passe incorrect.</span></br>";
    $_SESSION['fail_connect'] = 0;
  }
}
?>


<div class= "cent">
<?php if (isset($_SESSION['statut']) && $_SESSION['statut']=='M') echo "<h2><a href=\"nathane.php\">Nathane \"Le chef de meute\"</a></h2>";
else echo "<h2 class=\"cent\">Nathane \"Le chef de meute\"</h2>"; ?>
<p class="col-1"><img alt="Nathane" src="Membres/nathane.jpeg" height="380" /></p>
<p class="col-2 justify">Nathane, élève à la fois impliqué et décalé se sait le mieux. Chef de la meute et à l'origine de la création de ce groupe, il sait gérer les problèmes internes avec parcimonie et reste un chef à l'écoute de ses subordonnées. Intéressé par tout ce qui s'avère être intéressant pour lui, il possède toutes les qualités nécessaire pour être la tête d'affiche de La Meute: il n'est pas égoïste pour un sous mais pour deux il faut voir, il sait proposer son aide à ceux dans le besoin (demandé à humaniie les escrocs), il est très sociable et n'a pas de mal à se lier d'amitié même avec les bouffons d'humaniie (encore eux) et enfin il sait vendre comme tout bon commercial son produit (sa production de bonheur quotidienne).</p>
</div>

<div class="cent">
<?php if (isset($_SESSION['statut']) && $_SESSION['statut']=='M') echo "<h2><a href=\"hugo.php\">Hugo \"L'Ancien\"</a></h2>";
else echo "<h2>Hugo \"L'ancien\"</h2>"; ?>
<p class="col-1"><img alt="Hugo" src="Membres/hugo.jpeg" height="380" /></p>
<p class="col-2 justify">Hugo, est sans doute l’élève qui a le plus de flow de la meute. Vous vous demandez sûrement pourquoi ? Dommage pour vous, il ne donnera jamais sa recette. Cependant, avec Louis, ils sont là pour rehausser le niveau intellectuel de la meute, tout en délivrant leur savoir aux 3 autres louveteaux. Malgré les croyances populaires, c’est Hugo qui a créé ce groupe de compagnons avant qu’ils ne deviennent tous des loups. C’est pour cela qu’il est considéré comme « L’Ancien » de la meute. Celui qui possède les solutions adéquates et qui trouve tout le temps les bons mots pour conseiller. Bref, c’est un élément central et important de la meute.</p>
</div> 

<div class="cent">
<?php if (isset($_SESSION['statut']) && $_SESSION['statut']=='M') echo "<h2><a href=\"aime/aime.php\">Aimé \"Michto\"</a></h2>";
else echo "<h2>Aimé \"Le Michto\"</h2>"; ?>
<p class="col-1"><img alt="Aimé" src="Membres/aime.jpeg" height="400" /></p>
<p class="col-2 justify">De ces 21 ans, le jeune et charmant Aimé semble heureux dans sa vie. Pourquoi vous parlerais'je de mes études (#ENSIIE) ou de mon amour pour l'argent (#Shopping), mon Curriculum Vitae se restreint t'il a cela ?
La vie que l'on mène ne se retrouve t-elle simplement pas dans nos moments de détente, entouré de celles et ceux qui épanouisse vôtre âme.
Ceci n'est pas une description de moi, mais simplement une philosophie, vivre sa vie, prendre le temps du temps (pourquoi se presser quand t'es en retard #ENSIIE).
<br/>
ps : pour une description d'Aimé, on compte qualités et défauts suivant :<br/>
mignon, trop gentil, social, persévérant (il en faut dans ce monde de débandade), vieux fou, Sombre Mélodie, Dems !</p>
</div>

<div class="cent">
<?php if (isset($_SESSION['statut']) && $_SESSION['statut']=='M') echo "<h2><a href=\"flo.php\">Florence \"Gus\"</a></h2>";
else echo "<h2>Florence \"Gus\"</h2>"; ?>
<p class="col-1"><img alt="Flo" src="Membres/flo.jpeg" height="380" /></p>
<p class="col-2 justify">Nul le temps de vous baratiner avec un long paragraphe, mes frères de meute le font déjà si bien.<br/>
Simple et directe, voilà qui je suis.<br/><br/>
Mon quote préféré: <br/>
<em>"Il n'y a pas plus con qu'un con qui croit un con qui prend les gens pour des cons" </em> (Gus)</p>
</div>

<div class="cent">
<?php if (isset($_SESSION['statut']) && $_SESSION['statut']=='M') echo "<h2><a href=\"louis.php\">Louis \"Le Dr. artistique\"</a></h2>";
else echo "<h2>Louis \"Le Dr. artistique\"</h2>"; ?>
<p class="col-1"><img alt="Louis" src="Membres/louis.jpeg" height="380" /></p>
<p class="col-2 justify">Ce roi de la boutade ne fait pas dans la quantité, mais dans la qualité. Toujours, là, pour ses amis, il ne laisse jamais un appel sans réponse. Ce sont ces qualités qui lui ont permis de faire sa place au sein de la meute dans laquelle il parvient à s'épanouir pleinement. Prenant à cœur son rôle de directeur artistique, il est à l'origine du logo aujourd'hui devenu symbole de la meute. Toujours présent en cours aux côtés de son fidèle ami Hugo et un membre actif des associations en compagnie de Nathane vous ne pourrez pas le manquer dans les couloirs de l'école.</p>
</div>

<div class="cent">
<h2>Imane "L'invitée"</h2>
<p class="col-1"><img alt="Louis" src="Membres/imane.jpeg" height="380" /></p>
<p class="col-2 justify">Hello Hello , je m’appelle Imane et j’habite à EVRY, au cœur du 91. Magnifique région que j’affectionne-ou pas- tout particulièrement.
Je suis née il y a un certain nombre d’années déjà, en juin (le 13). Je suis du signe des Gémeaux et du Chien dans l’horoscope chinois.
Mon âge ? cela n’a pas d’importance. 
Je suis entière, j’aime les choses claires. Je dis ce que je pense, n’en déplaise à certains. Je pleure facilement, en regardant un film, en lisant un texte émouvant, une histoire triste. Trop émotive ? Peut-être, mais je ne changerai plus.
J’ai une sainte horreur de l'hypocrisie et du mensonge. Je n'aime pas les menteurs, les fourbes, les profiteurs, les vaniteux et les chats .
Si je pouvais : Alors, j'aimerais pouvoir aider les femmes à dépasser leurs angoisses, leur rendre goût à la vie, revoir leurs yeux briller à la place d'un regard éteint et reprendre confiance tout simplement.
Voilà, quelques lignes sur ma petite personne…</p>
</div>

</body>
</html>