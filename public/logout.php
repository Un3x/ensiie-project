<?php
// Start the session
session_start ();

// Destroy the session variables
session_unset ();

// Destoy the session
session_destroy ();

$member = null;

// Redirect the user to the home page
header ('location: loginView.php');
?>
