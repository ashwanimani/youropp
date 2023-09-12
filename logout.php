<?php
// Start the session (if not already started)
session_start();

// Check if the user is logged in (you may need to adjust the condition)
if (isset($_SESSION['user_id'])) {
    // Unset all of the session variables (clear the user's session)
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the login page or any other appropriate page
    header("Location: login.html");
    exit();
} else {
    // If the user is not logged in, redirect them to the login page
    header("Location: login.html");
    exit();
}
?>
