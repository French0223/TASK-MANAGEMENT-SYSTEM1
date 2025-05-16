<?php
// notification_functions.php
// Reusable notification functions for the system

/**
 * Adds a notification message for a given user.
 *
 * @param mysqli $conn The MySQLi connection object.
 * @param int $user_id The ID of the user to notify.
 * @param string $message The notification message.
 * @return bool True on success, false on failure.
 */
function addNotification($conn, $user_id, $message) {
    $stmt = $conn->prepare("INSERT INTO notifications (user_id, message, is_read, created_at) VALUES (?, ?, 0, NOW())");
    if (!$stmt) {
        return false;
    }
    $stmt->bind_param("is", $user_id, $message);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

// Example usage:
// include('notification_functions.php');
// addNotification($conn, $user_id, "Welcome to the system!");
?>
