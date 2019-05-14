<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
* {
  box-sizing: border-box;
}

.row::after {
  content: "";
  clear: both;
  display: block;
}

[class*="col-"] {
  float: left;
  padding: 15px;
}

html {
  font-family: "Lucida Sans", sans-serif;
}

.header {
  background-color: #9933cc;
  color: #ffffff;
  padding: 15px;
}

.menu ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

.menu li {
  padding: 8px;
  margin-bottom: 7px;
  background-color: #33b5e5;
  color: #ffffff;
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}

.menu li:hover {
  background-color: #0099cc;
}

.aside {
  background-color: #33b5e5;
  padding: 15px;
  color: #ffffff;
  text-align: center;
  font-size: 14px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}

.footer {
  background-color: #0099cc;
  color: #ffffff;
  text-align: center;
  font-size: 12px;
  padding: 15px;
}

/* For desktop: */
.col-1 {width: 8.33%;}
.col-2 {width: 16.66%;}
.col-3 {width: 25%;}

.col-5 {width: 41.66%;}
.col-6 {width: 50%;}
.col-7 {width: 58.33%;}
.col-8 {width: 66.66%;}
.col-9 {width: 75%;}
.col-10 {width: 83.33%;}
.col-11 {width: 91.66%;}
.col-12 {width: 100%;}

@media only screen and (max-width: 768px) {
  /* For mobile phones: */
  [class*="col-"] {
    width: 100%;
  }
}
</style>
</head>

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
<body>

<div class="header">
  <h1>Chania</h1>
</div>

<div class="row">
  <div class="col-3 menu">
    <ul>
    <li>The Flight</li>
    <li>The City</li>
    <li>The Island</li>
    <li>The Food</li>
    </ul>
  </div>

  <div class="col-6">
  <h1 id="histoire">Histoire</h1>
      <p class="justify"><span>I</span>l était une fois à Evry, loin, très loin de Paris (RER D tout ça tu connaîs), quatre jeunes <strong>louveteaux</strong>.<br/> <b class="acc">Nathane</b> le louveteau se pensant dominant eu l'idée de créer et de manigancer un stratagème afin de mettre fin à la suprématie des <em>geeks</em> !<br />Afin de mener son projet à bien il définit des rôles à chacun de ses <em>compatriotes</em> : <br /></p>
   <ul>
      <li> <b class="acc">Hugzer </b> <em>le vice président</em> </li>
      <li> <b class="acc">Gohan</b> <em>le directeur artistique</em> </li>
      <li> <b class="acc">El Patron </b><em>l'agent secret</em> </li>
      </ul>
      <p class="justify">A la suite d'un èvenement <strong>irréversible</strong> la meute décida de s'expanser afin d'éradiquer un noyau dur de <em>bouffons</em>.<br />Des candidats se présentèrent ... <br/>
Une jeune loupiote répondant au nom de <b class="acc">Gus</b> sortait du lot grâce notamment à sa carrure, sa force, et son humour (plus élevés que certains loups de la meute). Une épreuve l'attendait avant d'intégrer complètement la meute : </br>
il lui fallait passer <em><strong>le</strong> casting</em>.</p>
<p class="center"><img src="Membres/meute.jpeg" alt="La meute" height="400"/></p>
  </div>

  <div class="col-3 right">
    <div class="aside">
    <h3>Actualité</h3>
<?php $req=$connection->query('SELECT * FROM actualite'); ?>
<p><ul>
  <?php while($donnees=$req->fetch()) { ?>
  <li><?php if ($donnees['actu']!=NULL) echo $donnees['actu']; ?></li>
  <?php } ?>
</ul></p>
<?php
if (isset($_SESSION['statut'])) {
  if ($_SESSION['statut']=='M') { ?>
  <form method="post" action="actu.php">
      Ajouter une actualité<br/>
      <input type="text" class="inscription" name="add" />
      Supprimer une actualité<br/>
      <input type="text" class="inscription" name="delete" />
      <input type="submit" value="Envoyer" class="send"/> <input type="reset" value="Annuler" class="cancel"/>
  </form>
<?php  }
}
?>
    </div>
  </div>
</div>

<div class="footer">
  <p>Resize the browser window to see how the content respond to the resizing.</p>
</div>

</body>
</html>
