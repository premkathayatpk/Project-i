<?php
session_start(); // Starting the session

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login page after logout
header("Location: login.php");
exit();
?>
