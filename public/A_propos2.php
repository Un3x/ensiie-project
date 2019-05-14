<?php session_start(); ?>
<?php include './Vue.php'; ?>

<html>
    <head>
<meta charset="UTF-8" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./A_propos_pres.css">
    </head>

    <body>
<?php  
    en_tete(isset($_SESSION['connecte']));
?>

<div id="description">
	<p><q>IImagE c'est l'association qui vend du rêve à toutes les autres.</q></p>
<p>	Notre but : vous faire venir chez nous en vous montrant à quel point l'ENSIIE, c'est cool ! 
Si tu veux rejoindre une équipe soudée, dynamique et motivée, IImagE est là. Bien sûr, nous ne pouvons prospérer qu'avec une équipe motivée.</p>

<h3>La communication</h3>
<p>On va sur les forums étudiants pour présenter l'école, parler de son ambiance et créer les émeutes. 
On diffuse la plus belle image possible de notre sanctuaire via les forums (réels ou informatiques) et même dans les prépas directement.
Tu verras que cette communication que nous développons dans cette association est bénéfique dans le monde de l'entreprise.
Si tu veux savoir comment faire pour que ton forum se passe le mieux possible, vas voir le tuto <a href="how-to-go-to-forum.php">ici</a> ou pars à la rencontre de ton membre d'IImage favori.
</p>

<h3>La plaquette alpha</h3>
<p>On crée la plaquette alpha qui est ici. Eh oui ! On aime les belles choses. 
On passera du temps ensemble à peaufiner le style, les textes et le design de cette plaquette.</p>

<h3>La boutique</h3>
<p>IImagE, c'est aussi un projet de boutique où tu pourras acheter des goodies aux couleurs de l'école.
Si tu veux un mug, un T-shirt ou même un caleçon certifié ENSIIE, IImagE te le fournira.</p>
</div>

</body>
</html>

<?php pied(); ?>