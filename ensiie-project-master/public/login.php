<?php
    include("ini_session.php");
    require_once ('config.php');
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
    			<input type="text" name="username" />
        	</p>
        	<p>
        		<label>Password :</label>
        		<input type="password" name="password" />
        	</p>
        	<p>
        		<input type="submit" id="btn" value="Login" />
        	</p>
    	</form>
    </div>

    <?php include("footer.php"); ?>
</body>
</html>


