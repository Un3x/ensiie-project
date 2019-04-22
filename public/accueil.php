<?php
session_start();
$title = "Accueil";
$css_link = "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/accueilLayout.css\"/>";
echo $css_link;


require('../src/model.php');
$co = new Model();
$connection = $co->dbConnect();
?>

<?php ob_start(); ?>
    <body>
    <div class='corps'>
        <form action="logout.php" method="POST" id="logout_btn">
            <input type="submit" name="Logout" value="Logout">
        </form>
        <form action="lancer_discussion.php" method="POST" id="lancer_discu">
            <input type="submit" name="lancer_discu_btn" value="Lancer une discussion">
        </form>
        <div class='row'>
            <div class='column'>

                <table>
                    <tr>
                        <th>Historique</th>
                    </tr>
                    <tr>
                        <td>
                            <textarea rows="15" cols="50" name="histo">Appeler la fonction php affichant l'historique</textarea>
                        </td>
                    </tr>
                </table><br>
                <table>
                    <tr>
                        <th>Salon en cours</th>
                    </tr>
                    <tr>
                        <td>
                            <textarea rows="15" cols="50" name="salon">Appeler la fonction php affichant les salons</textarea>
                        </td>
                    </tr>
                </table><br>
            </div>
            <div class='column'>
                <table id="chat">
                    <tr>
                        <th>Chat en cours..</th>
                    </tr>
                    <tr><td><textarea rows="30" cols="100" name="conversation">Appeler la fonction php affichant les messages envoyés</textarea></td></tr>
                </table><br>
                <form id="send_msg_form" action="envoi_message.php" method="POST">
                    <input type="text" name="message_envoyé" placeholder="Ecrivez un message" class="message">
                </form><br>
                <form action="quitter_discussion.php" method="POST">
                    <input type="submit" name="quitter_discu_btn" value="Quitter la discussion">
                </form><br>
            </div>
        </div>
    </div>
<?php $content = ob_get_clean();

require('template.php'); ?>