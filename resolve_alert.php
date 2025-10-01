<?php
header('Content-Type: application/json');

$alertsFile = 'alerts.json';
$resolvedFile = 'resolved.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $alerts = json_decode(file_get_contents($alertsFile), true);
    $resolved = json_decode(file_get_contents($resolvedFile), true);

    foreach ($alerts as $index => $alert) {
        if ($alert['id'] == $id) {
            $alert['resolved'] = date('c');
            $resolved[] = $alert;
            array_splice($alerts, $index, 1);
            break;
        }
    }
    file_put_contents($alertsFile, json_encode($alerts, JSON_PRETTY_PRINT));
    file_put_contents($resolvedFile, json_encode($resolved, JSON_PRETTY_PRINT));

    echo json_encode(["status" => "ok"]);
    exit;
}
echo json_encode(["status" => "error", "message" => "Invalid request"]);
?>