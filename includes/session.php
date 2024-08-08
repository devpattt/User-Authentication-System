<?php
session_start();

// Function to check if a user is logged in
function checkSession() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
}

// Function to destroy session and log out user
function logout() {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>
