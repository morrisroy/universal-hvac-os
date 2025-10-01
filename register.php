<?php
session_start();
require_once "includes/json_db.php";

$accounts_file = "data/accounts.json";
$accounts = json_db_load($accounts_file);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if user already exists
    foreach ($accounts as $acc) {
        if ($acc['username'] === $username) {
            $error = "Username already exists.";
            include "templates/register_form.php";
            exit();
        }
    }

    // Determine role: first user = admin, others = user
    $role = empty($accounts) ? "admin" : "user";

    $new_user = [
        "username" => $username,
        "password" => $password,
        "role" => $role
    ];

    $accounts[] = $new_user;
    json_db_save($accounts_file, $accounts);

    $_SESSION['user'] = $new_user;
    header("Location: menu.php");
    exit();
}

include "templates/register_form.php";
?>