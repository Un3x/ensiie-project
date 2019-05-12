<?php
require_once(__DIR__.'/../User/UserRepository.php');
require_once(__DIR__.'/../generalTools.php');

require(__DIR__.'/../config.php');

global $userRepository;
//print_r($userRepository);

if(isset($_POST['email']) && isset($_POST['pwd'])){
  //echo "email : " . $_POST['email'] . '<br>';
  //echo "pwd : " . $_POST['pwd'] .'<br>';
  $pwdh = hash('md5',$_POST['pwd']);
  $em = $_POST['email'];
  //echo $pwdh;



  $userLogged = LoginTools::logInUser($em, $pwdh, $userRepository);
  if($userLogged){
    // remplir session
    LoginTools::fillSessionArray($userLogged);
    $nad = $_SERVER['HTTP_HOST'] . '/welcome.php';
    header("Location: http://$nad");
  } else {
    $_SESSION['testco'] = TRUE;
    //header('../../public/login.php');
  }
}