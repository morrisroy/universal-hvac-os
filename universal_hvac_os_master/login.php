<?php
require_once 'includes/json_db.php';
session_start();
$notice='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $username = $_POST['username']??''; $password = $_POST['password']??'';
    $users = read_json('data/accounts.json');
    foreach($users as $u){ if($u['username']===$username && password_verify($password,$u['password'])){ session_regenerate_id(true); $_SESSION['user']=$u; header('Location: menu.php'); exit; } }
    $notice='Invalid credentials';
}
?><!doctype html><html><head><meta charset='utf-8'><title>Login</title><link rel='stylesheet' href='style.css'></head><body>
<div class='card'><h2>Login</h2><?php if($notice) echo '<p class="err">'.htmlspecialchars($notice).'</p>'; ?>
<form method='post'><input name='username' placeholder='username' required><input type='password' name='password' placeholder='password' required><button>Login</button></form>
<p><a href='register.php'>Register</a></p></div></body></html>