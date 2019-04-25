<?php
session_start();
use Member\MemberRepository;


$title = "Accueil";
$css_link = "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/accueilLayout.css\"/>";
echo $css_link;


require('../src/model.php');
include('../src/Member/Member.php');
include('../src/Member/MemberRepository.php');

$model = new Model();
$connection = $model->dbConnect();

$memberRepository = new MemberRepository($connection);
$members = $memberRepository->fetchAll();

foreach ($members as $member) {
    if ($member->getEmail()==$_POST['email']) $currentMember = $member;
}
?>

<?php ob_start(); ?>
    <div class='corps'>
        <?php
        $firstname_tmp=$_SESSION['firstname'];
        $lastname_tmp=$_SESSION['lastname'];
        echo "$firstname_tmp ";
        echo $lastname_tmp;;?>
        <form action="logout.php" method="POST" id="logout_btn">
            <input type="submit" name="Logout" value="Logout">
        </form>
        <form role="form" method="POST" enctype="multipart/form-data">
            <input type="submit" name="lancer_discu_btn" value="Lancer une discussion">
        </form>
        <form action="profile.php" method="POST" id="profile_btn">
            <input type="submit" name="Profile" value="Profil">
        </form>

        <div class='row'>
            <div class='column'>
                <table>
                    <tr>
                        <td>
                            <table>
                                <caption>Historique</caption>
                                <tr>
                                    <td>
                                        <textarea rows="10%" cols="50%" name="histo">Appeler la fonction php affichant l'historique</textarea>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td rowspan="2">
                            <table id="chat">
                                <caption>Chat en cours..</caption>
                                <tr>
                                    <td>
                                        <textarea rows="30%" cols="100%" name="conversation">Appeler la fonction php affichant les messages envoyés</textarea>
                                    </td>
                                </tr>
                            </table>

                            <form role="form" method="POST" enctype="multipart/form-data">
                                <input type="text" name="message_envoyé" placeholder="Ecrivez un message" class="message">
                            </form><br>

                            <form role="form" method="POST" enctype="multipart/form-data">
                                <input type="submit" name="quitter_discu_btn" value="Quitter la discussion">
                            </form><br>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table>
                                <caption>Salon en cours</caption>
                                <tr>
                                    <td>
                                        <textarea rows="15" cols="50%" name="salon">Appeler la fonction php affichant les salons</textarea>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
<?php $content = ob_get_clean();

require('template.php'); ?>