<?php
session_start();

error_reporting(E_ALL & ~E_NOTICE);

include_once('../src/Member/Member.php');
include_once('../src/Member/MemberRepository.php');

$firstname_tmp=$_SESSION['firstname'];
$lastname_tmp=$_SESSION['lastname'];

/*try {
    if(!($firstname_tmp = $_SESSION['firstname']) || !($lastname_tmp = $_SESSION['lastname'])){throw new Exception('Veuillez vous connecter !');}}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();}*/

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

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" const="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meetiie - Accueil</title>
    <link rel="stylesheet" type="text/css" href="css/accueilLayout.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
</head>

<body>

<header>
    <h1>MEETIIE</h1>

    <?php try {if(!($firstname_tmp = $_SESSION['firstname']) || !($lastname_tmp = $_SESSION['lastname'])){throw new Exception("<div id=\"exception_msg\">Veuillez vous connecter -> <a href=\"loginView.php\"> Login !</a></div>");} else{?>

    <div id="role">
        <?php /** @var \Member\Member $member */
        if($member->getAdmin()) {echo "Admin";}
        else{echo "Utilisateur";}
        ?>
        <section id="username">
            <?php /** @var \Member\Member $member */
            echo $member->getFirstname() . " " . $member->getLastname();
            ?>
        </section>
    </div>
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
    <!--<div class="chatbox_right"></div>-->

    <section id="chatroom">
        <section id="feedback"></section>
    </section>

    <!--<form name="message" action="">
        <div class="field_and_button">
            <input name="usermsg" type="text" id="usermsg" size="100" placeholder="Entrer votre message" />
            <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
        </div>
    </form>-->

    <section id="input_zone">
        <input id="usermsg" class="vertical-align" type="text" size="100" placeholder="Entrer votre message" />
        <button id="submitmsg" class="vertical-align" type="button">Send</button>
    </section>

</div>

<div id="left_col">

    <div class="chatbox_left"></div><br>
    <div class="chatbox_left"></div>

</div>

<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="chat.js"></script>

<?php
}}catch(Exception $e) {
    echo $e->getMessage();
}
    ?>

</body>
</html>