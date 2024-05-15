<?php

// Start session
session_start();

// Check if user is logged in
if (isset($_SESSION['email'])) {
    echo "Welcome, " . $_SESSION['email'];
} else {
    echo "You are not logged in";
}

// Logout
if (isset($_POST['logout'])) {
    session_destroy();
    echo "You have been logged out";
}

?>
