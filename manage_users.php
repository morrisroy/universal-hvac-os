<?php
session_start();
require_once "includes/json_db.php";

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$accounts_file = "data/accounts.json";
$accounts = json_db_load($accounts_file);

// Handle actions: promote/demote/delete
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $username = $_POST['username'];

    foreach ($accounts as $i => $acc) {
        if ($acc['username'] === $username) {
            if ($action === 'promote') {
                $accounts[$i]['role'] = 'admin';
            } elseif ($action === 'demote') {
                $accounts[$i]['role'] = 'user';
            } elseif ($action === 'delete' && $username !== $_SESSION['user']['username']) {
                unset($accounts[$i]);
            }
            break;
        }
    }

    // Reindex array after delete
    $accounts = array_values($accounts);
    json_db_save($accounts_file, $accounts);

    header("Location: manage_users.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="menu-container">
        <h1>User Management</h1>
        <a href="menu.php">← Back to Menu</a>
        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>Username</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($accounts as $acc): ?>
                <tr>
                    <td><?php echo htmlspecialchars($acc['username']); ?></td>
                    <td><?php echo htmlspecialchars($acc['role']); ?></td>
                    <td>
                        <?php if ($acc['username'] !== $_SESSION['user']['username']): ?>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="username" value="<?php echo $acc['username']; ?>">
                                <?php if ($acc['role'] === 'user'): ?>
                                    <button type="submit" name="action" value="promote">Promote</button>
                                <?php else: ?>
                                    <button type="submit" name="action" value="demote">Demote</button>
                                <?php endif; ?>
                                <button type="submit" name="action" value="delete" onclick="return confirm('Are you sure?');">Delete</button>
                            </form>
                        <?php else: ?>
                            (You)
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>