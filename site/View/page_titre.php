<?php
if ($_SESSION['currentEvenement']->getType() == 'ObiLan')
    $page_title = 'Commander pour l\'ObiLAN '.$_SESSION['currentEvenement']->getNumero();
if ($_SESSION['currentEvenement']->getType() == 'NJV')
    $page_title = 'Commander pour la NJV '.$_SESSION['currentEvenement']->getNumero();
?>