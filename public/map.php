<?php include ('view.php');
 $ville = $_GET['ville'];
?>

<html>
	<head>
		<meta charset="utf-8">
		<?php my_head(); ?>
	</head>

	<body>
		<?php header_login(); ?>
		<div id="search">
			<form action="map.php">
			<span style="font-size:160%">Cherches à un autre endroit :</br></span>
			<input style="font-size:160%" type="text" name="ville" placeholder=" Entrez votre ville">
			</form>
		</div>
		Vous avez choisi cette ville : <?php echo $ville; ?></br>
		L'API map ne marche pas encore. Sera faite avec Leaf.js</br>
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d21095.64378046789!2d2.42426299850869!3d48.62983412299692!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e5de1eaa00cd73%3A0x2fc69a12a2793c39!2zw4l2cnk!5e0!3m2!1sfr!2sfr!4v1553784875694" width="600" height="450" frameborder="0" style="border:0" allowfullscreen>
		</iframe>
	<footer>
		<?php include ('footer.php'); footer();?>
	</footer>
	</body>
</html>
