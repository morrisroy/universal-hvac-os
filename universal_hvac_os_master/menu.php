<?php require_once 'includes/auth.php'; require_login(); ?>
<!doctype html><html><head><meta charset='utf-8'><title>Menu</title><link rel='stylesheet' href='style.css'></head><body>
<div class='card'><h2>Welcome, <?php echo htmlspecialchars($_SESSION['user']['username']); ?></h2>
<ul class='menu'><li><a href='alerts.php'>Alerts Dashboard</a></li><?php if(is_admin()) echo "<li><a href='technicians.php'>Manage Technicians</a></li>"; ?><li><a href='account.php'>Account</a></li><li><a href='logout.php'>Logout</a></li></ul></div></body></html>