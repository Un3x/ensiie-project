<?php
    include("ini_session.php");
    if (!isset($_SESSION['active']) || !$_SESSION['active']) echo '<meta http-equiv="refresh" content="0;URL=index.php">';
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
<?php echo '<p class = "hello">
    <br/> Bonjour '.$_SESSION['prenom'].' !
    </p>';
    ?>
<form action="modify_account.php" method="POST">
<p>
<?php
    echo 'Adresse email : '.$_SESSION['email'];
    ?>
</p>
<p>
<?php
    echo 'Nom : '.$_SESSION['nom'];
    ?>
</p>
<p>
<?php
    echo 'Prenom : '.$_SESSION['prenom'];
    ?>
</p>
<p>
<?php
    echo 'Sport : '.$_SESSION['sport'];
    ?>
</p>
<p>
<?php
    echo 'Genre : '.$_SESSION['genre'];
    ?>
</p>
<p>
<?php
    echo 'Tel : '.$_SESSION['tel'];
    ?>
</p>
<p>
<?php
    echo 'Type : '.$_SESSION['type'];
    ?>
</p>
<p>
<input type="submit" id="btn" value="Modifier" />
</p>
</form>
</div>
</div>
</div>
<?php include("footer.php"); ?>

</body>


</html>

