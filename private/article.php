<head>
	<link rel="stylesheet" href="../CSS/style.css">
</head>

<body>

<?php
require '../src/Article/Article.php';
require '../src/Article/ArticleRepository.php';
require '../src/Membre/Membre.php';

if(isset($_SESSION['pseudo'])){ //Si pas connecté, renvoie vers la page de connexion
    header("location: connexion.php");
}

$dbName = 'realitiie';
$dbUser = 'postgres';
$dbPassword = 'postgres';
$connection = new PDO("pgsql:host=localhost user=$dbUser dbname=$dbName password=$dbPassword");

$articleRepository = new \Article\ArticleRepository($connection);;
//$articleRepository = new \Article\ArticleRepository($connection);
$articles = $articleRepository->fetchWithoutTexte();
?>

<h1>Administration des articles</h1>

<h3>Cliquez sur un article pour le modifier ou le supprimer</h3>

<div style="overflow-x:auto;">
    <table>
    	<tr><th>Titre</th><th>Auteur</th><th>Nombre de commentaires</th><th>Date</th></tr>
    	<tr><td>FIIEts, celui qui est parti de Realitiie en emportant la caisse. 30 ans plus tard, il raconte son histoire</td><td>Un gars</td><td>21</td><td>20/05/2049</td></tr>
    	<tr><td>C'est prouvé scientifiquement! Des études très sérieuses montre que Carapuce est supérieur à Bowser en tout points</td><td>Professeur Chen</td><td>11</td><td>12/04/2019</td></tr>
    	<tr><td>L'ITALIE ENVAHIE L'ALGERIE!!! PRANK ÇA TOURNE MAL! EXPLICATION!!!</td><td>La vérité vrai de la réalité véritable</td><td>94548484</td><td>12/04/2019</td></tr>
    	<tr><td>TOP 10 des raisons pour laquelle la tarentelle est un super danse, la 8ème va vous surprendre!</td><td>Altreon</td><td>0</td><td>12/04/2019</td></tr>
    	<?php 
    	foreach ($articles as $article) {
    	    echo 
    	    '<tr><td>
                <a href="articleModification.php?id='.$article->getId().'">'.$article->getTitre().'</a></td><td>'.$article->getAuteur()->getSurnom().'</td><td>0</td><td>'.$article->getDate()->format('d/m/Y').'
             </td></tr>';
    	}
    	?>
    </table>
</div>
<form action="articleCreation.php"><input type="submit" class="plus" value="Écrire un Article"/></form>

</body>