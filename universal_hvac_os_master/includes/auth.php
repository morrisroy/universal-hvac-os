<?php
require_once __DIR__ . '/json_db.php';
session_name(defined('SESSION_NAME')?SESSION_NAME:'hvac_session');
session_start();
function find_user($username){
    $users = read_json(__DIR__.'/../data/accounts.json');
    foreach($users as $u) if($u['username']===$username) return $u;
    return null;
}
function require_login(){ if(empty($_SESSION['user'])){ header('Location: login.php'); exit; } }
function is_admin(){ return !empty($_SESSION['user']) && ($_SESSION['user']['role'] ?? '') === 'admin'; }
?>