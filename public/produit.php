<?php
session_start();
if (!isset($_SESSION['authent'])) {
    $_SESSION['authent'] = 0;
}

require '../vendor/autoload.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll(); 

$catRepository = new \User\CategorieRepository($connection);
$cats = $catRepository->fetchAll();

$phoRepository=new \User\PhotoRepository($connection);
$ProdRepository=new \User\ProduitRepository($connection);

require 'connexion.php';


require("header.php");
?>

<section>

<h2 class="sous_titre">Mon annonce</h2>

<!-- Photos -->
<div class="containerImages">

<!-- Full-width images with number text -->
<div class="mySlides">
  <div class="numbertext">1 / 3</div>
    <img class="big" src="voiture.jpg" style="width:100%">
</div>

<div class="mySlides">
  <div class="numbertext">2 / 3</div>
    <img class="big" src="hugo.JPG" style="width:100%">
</div>

<div class="mySlides">
  <div class="numbertext">3 / 3</div>
    <img class="big" src="TTT_green.png" style="width:100%">
</div>

<!-- Next and previous buttons -->
<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>

<!-- Image text -->
<div class="caption-container">
  <p id="caption"></p>
</div>

<!-- Thumbnail images -->
<div class="row">
  <div class="column">
    <img class="demo cursor" src="voiture.jpg" style="width:100%" onclick="currentSlide(1)" alt="photo1">
  </div>
  <div class="column">
    <img class="demo cursor" src="hugo.JPG" style="width:100%" onclick="currentSlide(2)" alt="photo2">
  </div>
  <div class="column">
    <img class="demo cursor" src="TTT_green.png" style="width:100%" onclick="currentSlide(3)" alt="photo3">
  </div>
</div>

</div> 

<!-- Description -->
<div class="information">
<div id="myDIV">
  <button class="btnInfo activeBtn">Description</button>
  <button class="btnInfo">hugo91600</button>
  <button class="btnInfo">D'Autres annonces du vendeur</button>
</div> 

<div class ="infoBOX" id="infoBOX">

  <div class="showInfo activeInfo">
    <div class="description">
      <h3>500 €</h3>
      <h4>Ville</h4>
      <p>Bonjour, je vends ma Peugeot 207<br/>
      <br/>
Marque : peugeot<br/>
Modèle : 207<br/>
Finition : Exécutive
Motorisation : 1.4 HDI<br/>
<br/>
Contrôle technique avec contre visite rotule avant droite à changer avec ressort.<br/>
<br/>
Courroie de distribution faite à 159000km facture à l'appuie.<br/>
Et révision à jour.<br/>
parcours toute distance.<br/>
<br/>
Options :<br/>
<br/>
- Ordinateur de bord<br/>
- Poste d'origine<br/>
- Fermeture centralisée ( double des clés )<br/>
- Commande au volant<br/>
- Climatisation<br/>
- Direction assistée<br/>
- vitres électriques<br/>
- Abs<br/>
- Airbag<br/>

Le véhicule est dans un bon état intérieur comme extérieur</p>
    </div>
  </div>

  <div class="showInfo">
    <div class="infoVendeur">
      <p> Bonjour comment ca va</p>
    </div>
  </div>

  <div class="showInfo">
    <div class="otherProd">
      <p>caca</p>
    </div>
  </div>

</div>
</div>
</section>

<script>
var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}     
</script>

<script>
// Get the container element
var btnContainer = document.getElementById("myDIV");
var infContainer = document.getElementById("infoBOX");

// Get all buttons with class="btn" inside the container
var btns = btnContainer.getElementsByClassName("btnInfo");
var infos = infContainer.getElementsByClassName("showInfo");

// Loop through the buttons and add the active class to the current/clicked button
for (var i = 1; i < infos.length; i++) {
  infos[i].style.display = "none";
}

for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("activeBtn");
    current[0].className = current[0].className.replace(" activeBtn", "");
    this.className += " activeBtn";
    for (var j=0; j<btns.length; j++){
      if (btns[j].className === "btnInfo activeBtn") {
        infos[j].style.display = "block";
      }
      else {
        infos[j].style.display = "none";
      }
    }
  });
}
</script>

<?php
require("aside.php");
require("footer.php");
?>
