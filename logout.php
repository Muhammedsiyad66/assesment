<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location:user_login.php");
    exit();
}

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the login page after signing out
header("Location: user_login.php");
exit();
?>
