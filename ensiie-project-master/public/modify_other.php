<?php
    include("ini_session.php");
    if (!isset($_SESSION['active']) || !isset($_SESSION['type']) || !$_SESSION['active'] || $_SESSION['type'] != "Organisateur") echo '<meta http-equiv="refresh" content="0;URL=index.php">';
    ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<title>Challenge Centrale Evry</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css?version=211" type="text/css">

<?php include ("header.php")?>
</head>

<body>
<div class="abc ligne2">
<div id="block" class="clear">


<div id="form_account" class="middle">
<form action="modify_other_process.php" method="POST">
<p>
<br/><br/>
<label for="email">Email :</label>
<input type="email" id ="email" name="email" required />
</p>
<p>
<label for="password">Password :</label>
<input type="password" id="password" name="pwd_modifier" required="" />
</p>
<p>
<label for="tel">Téléphone :</label>
<input type="text" id="tel" name="tel_modifier" required pattern="[0-9]{10}" />
</p>
<p>
<input type="submit" id="btn" value="Valider" />
</p>
</form>
<form action="index.php" method="POST">
<p>
<input type="submit" id="btn" value="Cancel" />
</p>
</form>
</div>
</div>
</div>
<?php include("footer.php"); ?>

</body>
</html>
