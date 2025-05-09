<?php
session_start();
if (!isset($_SESSION['username'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

include(__DIR__ . "/../connection.php");

$user_query = $conn->prepare("SELECT id FROM users WHERE username = ?");
$user_query->bind_param("s", $_SESSION['username']);
$user_query->execute();
$user_result = $user_query->get_result();
if ($user_result->num_rows === 0) {
    http_response_code(404);
    echo json_encode(['error' => 'User not found']);
    exit();
}
$user = $user_result->fetch_assoc();
$user_id = $user['id'];

$notif_query = $conn->prepare("SELECT id, message, is_read, created_at FROM notifications WHERE user_id = ? ORDER BY created_at DESC");
$notif_query->bind_param("i", $user_id);
$notif_query->execute();
$notif_result = $notif_query->get_result();

$notifications = [];
while ($row = $notif_result->fetch_assoc()) {
    $notifications[] = $row;
}

header('Content-Type: application/json');
echo json_encode($notifications);
?>
