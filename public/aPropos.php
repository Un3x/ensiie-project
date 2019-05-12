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
    <h2 class="sous_titre">Qui sommes-nous ?</h2>
    <img src="MH.png" alt="photo des entrepreneurs" class="entrepreneur"/>
    <p class="startup"><span style="font-weight: bold;">"Trouve Ton Truc"©</span> est une start-up créée par 2 entrepreneurs et autres colaborateurs.
    Le site fut lancé le mardi 14 mai 2019, pour répondre à un problème grandissant : se procurrer des biens et des services quand on est étudiant,
    et cela au sein même de son campus ! TTT répond à se besoin ! En effet, dans un premier temps TTT fut confectionné pour le campus d'Evry,
    et plus particulièrement pour les élèves de l'ENSIIE. Puis, de fil en aiguille, nous nous sommes développés pour couvrir tous les campus de France.</p>

    <h2 class="sous_titre">Nos locaux :</h2>
    <div class="locaux">
    <iframe class="googleMap" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2637.117346317931!2d2.43028571584226!3d48.62673647926557!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e5de1c6e78c237%3A0x16127c63fcccc119!2s1+Rue+de+la+R%C3%A9sistance%2C+91000+%C3%89vry!5e0!3m2!1sfr!2sfr!4v1556893779119!5m2!1sfr!2sfr" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
    <p>1 Square de la Résistance, 91000 Évry</p>
    </div>
</section>

<?php
require("aside.php");
require("footer.php");
?>