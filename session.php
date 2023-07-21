<?php
// session_handler.php

// Start the session
session_start();

// Check if the user is not logged in and redirect to the login page
function checkLoggedIn() {
    if (!isset($_SESSION["username"])) {
        header("Location: login.php");
        exit();
    }
}

// Get the logged-in username
function getUsername() {
    return isset($_SESSION["username"]) ? $_SESSION["username"] : null;
}
?>
