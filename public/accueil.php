<?php
session_start();

$title = "Meetiie - Accueil";
$css_link = "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/accueilLayout.css\"/>";
echo $css_link;


include_once('../src/Member/Member.php');
include_once('../src/Member/MemberRepository.php');

$firstname_tmp=$_SESSION['firstname'];
$lastname_tmp=$_SESSION['lastname'];

require('../src/model.php');
$model = new Model();
$connection = $model->dbConnect();

$memberRepository = new \Member\MemberRepository($connection);
$members = $memberRepository->fetchAll();
$member = new \Member\Member();

foreach ($members as $m) {
    if ($m->getEmail()==$_SESSION['email']) {
        $member = $m;
    }
}
?>
<?php ob_start(); ?>

        <!-- NEW COOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOODE -->

    <header>
        <h1>MEETIIE</h1>
        <div id="userName">
            <?php /** @var \Member\Member $member */

            if($member->getAdmin()) {echo "Admin : ";}
            else{echo "Utilisateur : ";}
            echo $member->getFirstname() . " ";
            echo $member->getLastname();
            ?><br></div>
    </header>

    <nav>
        <form target="_self" method="POST" style="display:inline-block;">
            <input type="text" name="chatRoom" id="chatRoom" size="20" placeholder="Nom du salon">
            <input type="submit" name="createRoom" id="createRoom" value="Créer le salon">
        </form>
        <div class="top-bar-left" style="display:inline-block;float:right;">
            <div class="menu">
                <button type="button">Lancer une discussion</button>
                <a href="<?php if($member->getAdmin() && isset($firstname_tmp) && isset($lastname_tmp)) {echo "profil_admin.php";} else if(isset($firstname_tmp) && isset($lastname_tmp)) {echo "profil.php";} else {echo"loginView.php";}?>"><button type="button">Profil</button></a>
                <a href="logout.php" ><button type="button">Logout</button></a>
            </div>
        </div>
    </nav><br>

    <div id="right_col">
        <div class="chatbox_right"></div>
        <form name="message" action="">
            <div class="field_and_button"><input name="usermsg" type="text" id="usermsg" size="100" placeholder="Entrer votre message" />
                <input name="submitmsg" type="submit"  id="submitmsg" value="Send" /></div>
        </form>
    </div>
    <div id="left_col">
        <div class="chatbox_left"></div><br>
        <div class="chatbox_left"></div>
    </div>
<?php $content = ob_get_clean();

require('template.php'); ?>