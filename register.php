<?php
require_once 'includes/json_db.php';
$notice='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $username = trim($_POST['username']); $password=$_POST['password']; $email=$_POST['email']??'';
    $users = read_json('data/accounts.json');
    foreach($users as $u) if($u['username']===$username) $notice='Username exists';
    if(!$notice){ $hash=password_hash($password,PASSWORD_DEFAULT); $id = (count($users)?end($users)['id']+1:1); $users[]=['id'=>$id,'username'=>$username,'password'=>$hash,'role'=>'viewer','email'=>$email]; write_json('data/accounts.json',$users); $notice='Registered. You may login.'; }
}
?><!doctype html><html><head><meta charset='utf-8'><title>Register</title><link rel='stylesheet' href='style.css'></head><body>
<div class='card'><h2>Register</h2><?php if($notice) echo '<p>'. $notice .'</p>'; ?>
<form method='post'><input name='username' required placeholder='username'><input name='email' placeholder='email'><input type='password' name='password' required placeholder='password'><button>Register</button></form></div></body></html>