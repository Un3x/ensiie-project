<?php
session_start();
if (!isset($_SESSION['authent'])) {
    $_SESSION['authent'] = 0;
}

if (!isset($_SESSION['statut'])) {
  $_SESSION['statut'] = 0;
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

<?php

if(isset($_POST['id'],$_POST['delete'])){
  if($_POST['delete']==1){
      $connection->query("UPDATE produits SET valide='2' WHERE id_produit='".$_POST['id']."';");
      echo "Produit bien supprimé<br/>";
      $_POST['id']=null;
      $_POST['delete']=null;
      echo "<meta http-equiv=\"Refresh\" content=\"2;url=index.php\">";
      exit();
  }
}

  if (!isset($_GET['produit'])){
    echo "Ce produit n'existe pas";
    echo "<meta http-equiv=\"Refresh\" content=\"2;url=index.php\">";
    exit();
  }

  if (!ctype_digit($_GET['produit'])){
    echo "Ce produit n'existe pas";
    echo "test";
    echo "<meta http-equiv=\"Refresh\" content=\"2;url=index.php\">";
    exit();
  }


  $_GET['produit']= (int) $_GET['produit'];
  $CurrProduit = $ProdRepository->getSpecificProd($_GET['produit']);
  if ($CurrProduit==[]){
    echo "Ce produit n'existe pas";
    echo "<meta http-equiv=\"Refresh\" content=\"2;url=index.php\">";
    exit();
  }


  if ($CurrProduit[0]->getValide()!=1 && $_SESSION['statut']!=1){
    echo "<br\>Ce produit n'existe pas";
    echo "<meta http-equiv=\"Refresh\" content=\"2;url=index.php\">";
    exit();
  }

  $pseudo_priprio=$CurrProduit[0]->getIdProprio();
  $iduser=$CurrProduit[0]->getIdProd();
  $CurrUser = $userRepository->testpseudo($pseudo_priprio);
  $cheminphoto = $userRepository->getPhoto($pseudo_priprio);

  $photo1 = $ProdRepository->getPhoto1($CurrProduit[0]->getIdProd());
  $photo2 = $ProdRepository->getPhoto2($CurrProduit[0]->getIdProd());
  $photo3 = $ProdRepository->getPhoto3($CurrProduit[0]->getIdProd());

  // if ($photo1 == null) {
  //   $photo1 = "/upload/3.png";
  // }
  // if ($photo2 == null) {
  //   $photo2 = "/upload/3.png";
  // }
  // if ($photo3 == null) {
  //   $photo3 = "/upload/3.png";
  // }
?>


<h2 class="sous_titre"><?php echo $CurrProduit[0]->getTitle(); ?></h2>

<!-- Photos -->
<div class="containerImages">

<!-- Full-width images with number text -->
<div class="mySlides">
  <div class="numbertext">1 / 3</div>
    <img class="big" src="<?php echo $photo1 ?>" style="width:100%">
</div>

<div class="mySlides">
  <div class="numbertext">2 / 3</div>
    <img class="big" src="<?php echo $photo2 ?>" style="width:100%">
</div>

<div class="mySlides">
  <div class="numbertext">3 / 3</div>
    <img class="big" src="<?php echo $photo3 ?>" style="width:100%">
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
    <img class="demo cursor" src="<?php echo $photo1 ?>" style="width:100%" onclick="currentSlide(1)" alt="photo1">
  </div>
  <div class="column">
    <img class="demo cursor" src="<?php echo $photo2 ?>" style="width:100%" onclick="currentSlide(2)" alt="photo2">
  </div>
  <div class="column">
    <img class="demo cursor" src="<?php echo $photo3 ?>" style="width:100%" onclick="currentSlide(3)" alt="photo3">
  </div>
</div>

</div> 

<script>
  function show(etat,id)
  {
     document.getElementById(id).style.display=etat;
  }
</script>

<?php
if ($_SESSION['statut']==1 && $CurrProduit[0]->getValide()==1){
 echo 
 "<form method=\"post\" action=\"#\">
     <div class=\"flexbox_button\">
         <div class=\"bouton\">
             <input type=\"reset\" onclick=\"show('block','".$iduser."')\" value=\"&#128465; Supprimer\" name=\"supprimer\">
         </div>
     </div>
 </form>
 <div id=\"".$iduser."\">
 Êtes-vous sur de vouloir supprimer ce produit ?
 <form method=\"post\" action=\"#\">
     <input type=\"hidden\" name=\"id\" value=\"".$iduser."\">
     <input type=\"hidden\" name=\"delete\" value=\"1\">
     <div class=\"flexbox_boutton\">
         <div class=\"bouton\">
             <input type=\"submit\" value=\"Oui\" name=\"Oui\">
         </div>
         <div class=\"bouton\">
             <input type=\"reset\" onclick=\"show('none','".$iduser."')\" value=\"Non\" name=\"Non\">
         </div>
     </div>
 </form>
 </div>
 <script type=\"text/javascript\">show('none','".$iduser."');</script>";
}
?>

<!-- Description -->
<div class="information">
<div id="myDIV">
  <button class="btnInfo activeBtn">Description</button>
  <button class="btnInfo"><?php echo $CurrUser[0]->getId();?></button>
  <button class="btnInfo">D'Autres annonces du vendeur</button>
</div> 

<div class ="infoBOX" id="infoBOX">

  <div class="showInfo activeInfo">
    <div class="description">
      <?php
      $catduprod=$catRepository->getCatofP($CurrProduit[0]->getIdProd());
      foreach($catduprod as $cat){
        echo "<a href=\"cat.php?id=".$cat->getId()."\"><strong>#".$cat->getNomCat()." </strong></a>";
      }
      ?>
      <h3><?php
      if ($CurrProduit[0]->getPrice()==0){
        echo "Gratuit";
      }
      else{ 
        echo $CurrProduit[0]->getPrice()." €"; 
      }?></h3>
      <h4><?php echo $CurrUser[0]->getLocation(); ?></h4>
      <p><?php echo $CurrProduit[0]->getDescription(); ?></p>
      <p><?php echo $CurrProduit[0]->getDatePubli()->format('Y-m-d'); ?></p>
    </div>
  </div>

  <div class="showInfo">
    <div class="infoVendeur">
      <?php $userRepository->afficheUser($CurrUser[0]); ?>
    </div>
  </div>

  <div class="showInfo">
    <div class="otherProd">
    <?php
    $prods=array_reverse($ProdRepository->getProdofUser($pseudo_priprio));
    if ($prods==[]){
      echo "L'utilisateur n'a aucune autre annonce";
    }
        $c=0;

        foreach ($prods as $prod){
          if (!($CurrProduit[0]->getIdProd()==$prod->getIdProd())){
                $ProdRepository->afficheProd($prod);
                if ($prod->getValide()){
                  $c=$c+1;
                }
              }
        }
      if ($c==0){
          echo "L'utilisateur n'a aucune autre annonce";
      }
    ?>
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
