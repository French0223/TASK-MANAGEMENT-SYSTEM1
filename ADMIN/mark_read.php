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

$update_query = $conn->prepare("UPDATE notifications SET is_read = 1 WHERE user_id = ?");
$update_query->bind_param("i", $user_id);
$update_query->execute();

if ($update_query->affected_rows > 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'No notifications updated']);
}
?>
