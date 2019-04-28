<?php
    include("ini_session.php");
    require_once ('config.php');
    if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) echo '<meta http-equiv="refresh" content="0;URL=index.php">';
?>

<html>
<head>
    <title>          Challenge Centrale Evry</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include("header.php"); ?>
    <?php include("menu.php"); ?>
    <div id="form_sign_in" class="middle">
    	<form action="process.php" method="POST">
    		<p>
    			<br/><br/>
    			<label>Username :</label>
    			<input type="text" name="login" />
        	</p>
        	<p>
        		<label>Password :</label>
        		<input type="password" name="pwd" />
        	</p>
        	<p>
        		<input type="submit" id="btn" value="Login" />
        	</p>
    	</form>
    </div>

    <?php include("footer.php"); ?>
</body>
</html>


