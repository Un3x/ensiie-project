<?php
    include("ini_session.php");
    if (isset($_SESSION['active']) && $_SESSION['active']) echo '<meta http-equiv="refresh" content="0;URL=index.php">';
    ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <title>Challenge Centrale Evry</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css" type="text/css">

        <?php include ("header.php");?>
    </head>

    <body>
        <div class="wrapper row2">
            <div id="container" class="clear">
                <div id="form_sign_in" class="middle">
                    <form action="login_process.php" method="POST">
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

            </div>
        </div>

        <?php include("footer.php"); ?>

    </body>
</html>

