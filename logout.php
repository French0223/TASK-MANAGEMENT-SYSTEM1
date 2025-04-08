<?php
session_start();
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

// Ensure no output before redirection
ob_start();
header("Location: index.php");
exit();
?>
