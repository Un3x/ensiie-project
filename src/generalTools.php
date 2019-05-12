<?php
require_once 'User/UserRepository.php';
require_once 'User/User.php';
class Tools
{

}

class LoginTools
{

    /**
     * return true if logged in, false else
     */
    public static function isLoggedIn()
    {
        session_start();
        if (array_key_exists('connected', $_SESSION)) {
            if ($_SESSION['connected']) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * usersArr = UserRepository
     */
    public static function logInUser($log, $pwh, $usersArr)
    {
/*         echo "LoginTools::logInUser : {<br>";
            echo "email : " . $log . '<br>';
            echo "pwd : " . $pwh .'<br>}'; */
        return $usersArr->logInWithCredentials($log, $pwh);
    }

    public static function fillSessionArray($user)
    {/* 
        echo "LoginTools::fillSessionArray : FILLING {<br>"; */
        $_SESSION['connected'] = TRUE;/* 
        echo "SESSION['connected'] : " . $_SESSION['connected'] . '<br>'; */
        $_SESSION['firstname'] = $user->getFirstName();/* 
        echo "SESSION['firstname'] : " . $_SESSION['firstname'] . '<br>'; */
        $_SESSION['lastname'] = $user->getLastName();
        /* echo "SESSION['lastname'] : " . $_SESSION['lastname'] . '<br>';
        echo "}<br>"; */
    }

}
