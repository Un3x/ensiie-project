<?php
// check if connected (TO DO ON ALL PAGES)
  session_start();
  require "majprofile.php";
  //fetch user data
  $dbName = getenv('DB_NAME');
  $dbUser = getenv('DB_USER');
  $dbPassword = getenv('DB_PASSWORD');
  $connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
  $stmt = $connection->prepare("SELECT firstname, lastname, mailaddress, userrole, picturepath FROM users WHERE firstname = ? AND lastname = ?");
  $stmt->execute([$_SESSION['firstname'],$_SESSION['lastname']]);
  $user = $stmt->fetch();
  //set variables
  $firstname = $user['firstname'];
  $lastname = $user['lastname'];
  $mail = $user['mailaddress'];
  $status = $user['userrole'];
  $picpath = $user['picturepath'];
?>

<!DOCTYPE html>
<html>
    <?php require '../src/components/head.php';?>
    <body id="connected">
        <div class="container">
            <?php require('../src/components/navbar_connection.php');?>
            <div id="my-account-container">
                    <h1>Mon compte</h1>
                <div id="my-account">
                    <div id="profile-pic-container">
                    <img id="avatar" src=<?php echo "$picpath" ?> alt="Profile picture">
                    <input type="file" accept="image/png, image/jpeg">
                    </div>
                    <div id="my-account-data">
                        <h3>Mes données</h3>
                        <table>
                            <tr>
                                <td>Mon nom</td>
                                <td><?php echo $lastname ?></td>
                            </tr>
                            <tr>
                                <td>Mon prénom</td>
                                <td><?php echo $firstname ?></td>
                            </tr>
                            <tr>
                                <td>Mon adresse email</td>
                                <td><?php echo $mail ?></td>
                            </tr>
                            <tr>
                                <td>Mon statut</td>
                                <td><?php echo $status ?></td>
                            </tr>
                        </table>
                    </div>
                    <div id="my-account-forms">
                        <h3>Mettre à jour mes données</h3>
                        <form method="post">
                            <h4>Modifier votre adresse mail</h4>
                            <input type="email" placeholder="Nouvelle adresse e-mail" name="newEmail" required>
                            <button class="button" type="submit">Mettre à jour</button>
                        </form>
                        <form method="post">
                            <h4>Modifier votre mot de passe</h4>
                            <input type="password" minlength="6" maxlength="50" placeholder="Mot de passe actuel" name="currentPwd" required>
                            <input type="password" minlength="6" maxlength="50" placeholder="Nouveau mot de passe" name="newPwd" required>
                            <button class="button" type="submit">Mettre à jour</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <svg class="curve" preserveAspectRatio="none" width="1450" height="160" viewBox="0 0 1450 160" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <g>
                <path d="M 0 160L 0 0C 552.762 3.38469e-14 829.144 157.977 1450 157.977L 1450 160L 0 160Z"/>
            </g>
        </svg>
        <?php require('../src/components/footer.php'); ?>
    </body>
</html>