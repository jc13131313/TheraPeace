<?php
session_start();

// Logout logic
session_destroy();

// Redirect to the login page
header('location: index.php');
exit();
?>