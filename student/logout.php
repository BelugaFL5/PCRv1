<?php
// Start the session to access session variables
session_start();

// Destroy all session variables
session_unset(); 

// Destroy the session
session_destroy(); 

// Optionally, you can also remove any session cookie if present
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/'); // Expire the session cookie
}

// Redirect the user to the login page
header("Location: ../login/login.php");
exit;
?>
