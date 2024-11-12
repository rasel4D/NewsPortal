<?php
// logout.php

// Start the session if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Clear all session variables
$_SESSION = array();

// Destroy the session cookie
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// Destroy the session
session_destroy();

// Set a logout message in a temporary cookie
setcookie('logout_message', 'You have been successfully logged out.', time() + 5, '/');

// Redirect to the login page
header('Location: login.php');
exit();
?>