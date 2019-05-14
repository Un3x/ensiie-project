<?php
require '../vendor/autoload.php';

//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();

?>

<html>
<head>
<style type="text/css">
    body {
      font-family: Arial;
      margin: 0;
      background-size:100% 100%;
      background-repeat:no-repeat;
    }
    a {
      color: Orangered;
      font-size: 20;
      padding: 14px 20px;
      text-decoration: none;
      text-align: center;
      margin
    }
    a:hover {
      color: chocolate;
    }
</style>

</head>
<title style="font-size: 50"><b>Bienvenu</b></title>
<body>
<div>
  <img src="back.jpg"  style="position: fixed;
z-index: -10; width: 100%; height: 100%;
top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(255, 255, 255, 0.01);  ">
</div>
<div class="bloc" style="margin-top: 150px" >
    <form action="LoginModel.php" method="post">
    <div align="center">
        <div style="font-size: 50">Bienvenu à CuIsInE</div>
        <table style="font-size: 30; margin-top: 50px;">
            <tr>
                <td>Surnom: </td>
                <td>
                    <input type="text" name="surnom">
                </td>
            </tr>
            <tr>
                <td>Mot de Passe: </td>
                <td>
                    <input type="password" name="mdp">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Se Connecter">
                    <input type="reset" value="Recommencer">
                </td>
            </tr>
        </table>
        <br/>
        <a href="Inscription.php">Inscription</a>
    </div>  
    </form>
</div>  
</body>
</html>
