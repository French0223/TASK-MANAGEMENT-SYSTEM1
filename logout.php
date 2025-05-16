<?php
session_start();

include("connection.php");
include("ADMIN/notification_functions.php");

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Get user ID from username
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];

        // Add logout notification
        addNotification($conn, $user_id, "Logged out");
    }
}

session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

// Ensure no output before redirection
ob_start();
header("Location: index.php");
exit();
?>
