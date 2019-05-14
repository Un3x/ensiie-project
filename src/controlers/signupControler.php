<?php
require_once(__DIR__.'/../User/UserRepository.php');
require_once(__DIR__.'/../generalTools.php');

require(__DIR__.'/../config.php');

global $userRepository;

if(isset( $_POST['lname']) && isset($_POST['fname'])
&& isset($_POST['email']) && isset($_POST['pwd'])
&& isset($_POST['validpwd']) && isset($_POST['activcode'])){
  $pwd1 = $_POST['pwd']; $pwd2 = $_POST['validpwd'];
  if ($pwd1 == $pwd2){
    // verif si user existe
    if (LoginTools::emailInBase($_POST['email'], $userRepository)){
      echo "<script type=\"text/javascript\">
      alert(\"Cet email est déjà enregistré. Contactez un responsable pour récupérer votre mot de passe si vous l'avez oublié. \");</script>";
    } else {
      // test si code activation tuteur
      $userrole = "etudiant";
      if ($_POST['activcode'] == "tuteur"){
        $userrole = "tuteur";
      }
      $pwdh = hash('md5',$_POST['pwd']);
      LoginTools::addUserInBase($userRepository, $_POST['fname'], $_POST['lname'], $_POST['email'], $pwdh, $_POST['activcode'], $userrole);
      echo "<script type=\"text/javascript\">alert(\"Inscription réussie. Vous pouvez vous connecter.\");</script>";
      $em = $_POST['email'];
      $userLogged = LoginTools::logInUser($em, $pwdh, $userRepository);
      if($userLogged){
        LoginTools::fillSessionArray($userLogged);
        $nad = $_SERVER['HTTP_HOST'] . '/welcome.php';
        //header("Location: http://$nad");
      }
    }
  } else {
    echo "<script type=\"text/javascript\">
    alert(\"Mots de passe différents.\");</script>";
  }
}