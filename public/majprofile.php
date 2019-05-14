<?php
  session_start();
  require '../src/User/UserRepository.php';
  require '../src/config.php';
  

global $userRepository;
$users = $userRepository->getUserArray();
$em = $_SESSION['email'];
$usid = $users[$em]->getId();
if(isset($_SESSION['newemail'])){
  
}

?>