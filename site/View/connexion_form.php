<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link href="media/css/ie10-viewport-bug-workaround.css" rel="stylesheet" />
		
		<link href="media/css/additional.css" rel="stylesheet" />

        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="media/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="media/js/additional.js"></script>
		<!--[if lt IE 9]>
			<script src="media/js/html5shiv.min.js"></script>
			<script src="media/js/respond.min.js"></script>
		<![endif]-->


		<title>Connexion</title>
</head>


<body>


<div class="container login-form">
<div class="row">
        <div class="col-sm-3 col-xs-6 col-xs-offset-3 col-sm-offset-0">
            <img class="img-responsive" src="media/images/logo-arise-white-ok.png" alt="AriseID" id="logo" aria-hidden="true"/>
        </div>
</div>
<div class="row">
	<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
		<div class="panel panel-info" >
			<div class="panel-heading">
				<div class="panel-title">Connexion</div>
			</div>

			<div class="panel-body" >
				<form name="formulaire" action="../Controller/login.php" onsubmit="return verification()" method="POST" role="form">
					<fieldset>
					<input type="hidden" name="csrf_token" value="3ff01557b608e2a566f21df21a0dc887" />

					<div class="form-group">
					<div class="input-group" aria-label="Identifiant">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
						<input type="text" id="login" name="login" class="form-control" placeholder="Identifiant" autofocus="autofocus" autocapitalize="off" autocorrect="off" />
					</div>
					</div>
					<div class="form-group">
					<div class="input-group" aria-label="Mot de passe">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock" aria-hidden="true"></i></span>
						<input type="password" id="pwd" name="pwd" class="form-control" placeholder="Mot de passe"/>
					</div>
					</div>
					<div class="form-group submit-group">
						<input type="submit" class="btn btn-lg btn-success btn-block" value="Se connecter" />
					</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
</div>

	<script src="media/js/ie10-viewport-bug-workaround.js"></script>
</body>

<script type="text/javascript" language="Javascript" > 

function verification() 
{ 

    if(document.formulaire.login.value == "") 
    { 
        alert("Veuillez entrer un login s'il vous plaît");
        document.formulaire.login.focus(); 
        return false; 
    } 

    if(document.formulaire.pwd.value == "") 
    { 
        alert("Veuillez entrer votre mot de passe s'il vous plaît"); 
        document.formulaire.pwd.focus(); 
        return false; 
    } 

    return true;
} 

</script> 


</html>