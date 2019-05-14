<?php
require '../vendor/autoload.php';
require '../src/User/UserRepository.php';
require '../src/User/User.php';
require_once('../src/Move/MoveRepository.php');
require_once('../src/Move/Move.php');
require_once('../src/Spot/SpotRepository.php');
require_once('../src/Spot/Spot.php');
require_once('../src/SpotXmove/SpotXmoveRepository.php');
require_once('../src/SpotXmove/SpotXmove.php');

include ('view.php');

//démarre une session pour garder l'utilisateur connecté entre les pages
session_start();

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();
$moveRepository = new \Move\MoveRepository($connection);
$moves = $moveRepository->fetchAll();
$spotRepository = new \Spot\SpotRepository($connection);
$spots = $spotRepository->fetchAll();

//récupration de la ville entrée par l'utilisateur
if (isset($_GET['ville'])) $ville = $_GET['ville'];

//si un utilisateur ajoute un nouveau spot
if (isset($_POST['spotname'])) {
    $spot = new \Spot\Spot();
    //récupérer la latitude et la longitude ??
    $spot->setLongitude($_POST['spotlongitude']);
    $spot->setLatitude($_POST['spotlatitude']);
    $spot->setNom($_POST['spotname']);
    $spot->setVille($_POST['spotcity']);
    $spot->setNote($_POST['spotnote']);
    $spotRepository->addSpot($spot);
}
?>

<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"-->
    <?php my_head(); ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>

</head>
<body>

    <?php header_login(); ?>

<div class="container">

	<div id="search">
		<form action="index.php">
		<span style="font-size:140%">Trouve le spot le plus près de chez toi :<br/></span>
		<input id="searchbar" type="text" name="ville" placeholder="Entrez votre ville">
		</form>
    </div>
    
    <div id="mapid">
		<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
   integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
   crossorigin=""></script>
        <script>
		var mymap = L.map('mapid').setView([48.623447, 2.425771], 14);
		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 20,
    id: 'mapbox.streets',
    accessToken: 'your.mapbox.access.token'
}).addTo(mymap);
	</script>
    </div>
    <?php foreach ($spots as $spot) :?>
	 <?php $lat = $spot->getlatitude();
          	$long = $spot->getLongitude();
		$name = $spot->getNom();
		$note = $spot->getNote();?>
		<script>
		 var marker = L.marker([<?php echo $lat?>,<?php echo $long?>]).addTo(mymap);
    		 marker.bindPopup("<b><?php echo $name?></b></br>Note:<?php echo $note?>");
		</script>
		<?php endforeach;?>
    

	<?php if (!isset($_SESSION['mail'])) {
        //bouton de création de compte si l'utilisateur n'est pas connecté
        echo "<div calss=\"flex-container\" style=\"margin-top: 20px\">
                <button class=\"bouton\" style=\"margin-left:45%\">
                <a href=\"connexion.php\">Créez-vous un compte !</a>
                </div>";
    } 
    //affichage de l'ajout d'un spot si l'utilisateur est cuonnecté
    else formSpot();
    ?>
    
</div>
<footer>
<?php footer();?>
</footer>
</body>
</html>
