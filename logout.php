<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the seesion
session_destroy();

// Redirect the user to the login page or perform any necessary actions
header("Location: index.php");
exit; 