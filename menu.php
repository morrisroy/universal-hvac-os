<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>HVAC OS - Main Menu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="menu-container">
        <h1>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h1>
        <h3>Main Menu</h3>
        <ul>
            <li><a href="alerts.php">View Alerts Dashboard</a></li>
            <?php if ($user['role'] === 'admin') : ?>
                <li><a href="technicians.php">Manage Technicians</a></li>
                <li><a href="manage_users.php">Manage Users</a></li>
            <?php endif; ?>
            <li><a href="account.php">Account Settings</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</body>
</html>
