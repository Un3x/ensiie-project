<?php require '../src/User/projetControl.php'; $status = $_SESSION['status'];?>
<?php entete("")?>
<!DOCTYPE html>
<html>
<head>
	<title>Recherche</title>
    <link rel="stylesheet" href="frontend/css/bootstrap.css">
	<link rel="stylesheet" href="frontend/css/font-awesome.css">
    <link rel="stylesheet" href="css/style.css" type="text/css">

    <style type="text/css">
    	form label{
    		color: white;
    		font-size: 18px;
    		font-family:consolas;
    	}
    </style>
    
</head>
<body style="background-color: #eee">
<div class="container" style="margin-top: 80px;">
    <div class="row">
<div class="col-md-6 col-md-offset-3" style="box-shadow: 0px 0px 8px 8px #D0D0D0;font-family: Consolas;border-radius: 15px;"><br>
	<a href="recherche_livre.php">	
		<button class="btn btn-success col-md-offset-3"  style="box-shadow: 0px 0px 8px 8px #D0D0D0;font-family: Consolas;border-radius: 15px;">Chercher un livre</button>
	</a><br><br>
	<a href="recherche_video.php">
		<button class="btn btn-warning col-md-offset-3"  style="box-shadow: 0px 0px 8px 8px #D0D0D0;font-family: Consolas;border-radius: 15px;">Chercher une video</button>
	</a><br><br>
	<a href="recherche_audio.php">
				<button class="btn btn-primary col-md-offset-3"  style="box-shadow: 0px 0px 8px 8px #D0D0D0;font-family: Consolas;border-radius: 15px;">Chercher un audio</button>
	</a></div>
		
</div></div>
<?php navigation($status); ?>
</body>
</html>