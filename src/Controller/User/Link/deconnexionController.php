<?php

session_destroy();
$GLOBALS['user']=null;
require('../src/View/User/Link/deconnexionView.php');