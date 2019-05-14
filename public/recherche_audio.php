<?php require '../src/User/projetControl.php'; $status = $_SESSION['status'];?>
<?php entete("")?>
<!DOCTYPE html>
<html>
<head>
	<title>Recherche audio</title>
    <link rel="stylesheet" href="frontend/css/bootstrap.css">
	<link rel="stylesheet" href="frontend/css/font-awesome.css">


    
    <style type="text/css">
    	form label{
    		color:black;
    		font-size: 18px;
    		font-family:consolas;
    	}
    </style>
    
</head>
<body style="background-color: #eee">
 
   
<div class="container" style="margin-top: 80px;">
    <div class="row">
   <div class="col-md-6 col-md-offset-3" style="box-shadow: 0px 0px 8px 8px #D0D0D0;font-family: Consolas;border-radius: 15px;">
		<form class="col-md-12" method="post"  action="traitementaudio.php" > 
			
				
			
				<div class="form-group">
					<label for="Nom">Titre de l'audio </label>
					<input type="text" name="nom" id="Nom" autofocus="" required="required" class="form-control">
				</div>

					
					

					
					<div class="form-group">

				<input type="submit" name="chercher" value="chercher" class="btn btn-info btn-primary">	
				</div>
			
		</form>
		</div>

	</div>
</div>
<br><br>
	
<?php navigation($status); ?>
</body>
</html>