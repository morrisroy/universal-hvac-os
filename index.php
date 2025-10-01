<?php
session_start();

// If user is logged in, redirect to menu
if (isset($_SESSION['user'])) {
    header("Location: menu.php");
    exit();
}

// Otherwise redirect to login
header("Location: login.php");
exit();
?>